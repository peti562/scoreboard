const express = require('express');
const bodyParser = require('body-parser');
const puppeteer = require('puppeteer');
const md5 = require('md5');
const consoleStamp = require('console-stamp');
const fs = require('fs');

consoleStamp(console, {
  pattern: 'dd/mm/yyyy HH:MM:ss.l'
});

const url = 'http://192.168.10.10/';

const app = express();

app
  .use(bodyParser.json())
  .use(bodyParser.urlencoded({
    extended: true
  }))
  .get('/generate/:route/:match_id', (req, res) => {
    const route = req.params.route;
    const match_id = req.params.match_id;
    const file_name = route+'_'+match_id+'_'+Math.floor(Math.random() * 6000) + 1000+'.jpg';
    (async () => {
      const browser = await puppeteer.launch({
        args: [
          // Required for Docker version of Puppeteer
          '--no-sandbox',
          '--disable-setuid-sandbox',
          // This will write shared memory files into /tmp instead of /dev/shm,
          // because Docker’s default for /dev/shm is 64MB
          '--disable-dev-shm-usage'
        ]    
      });
      const page = await browser.newPage();
      /*await page.goto(`${url}${route}&match_id=${match_id}`, {
        waitUntil: 'networkidle2'
      });*/
        await page.goto(`${url}${route}`, {
            waitUntil: 'networkidle2'
        });
      await page.waitForSelector('canvas');
      await page.waitFor(10000);
      await page.screenshot({
        path: file_name,
        fullPage: true
      });
      await browser.close();

      var stream = fs.createReadStream(file_name);
      stream.pipe(res).once("finish", function () {
        stream.destroy(); // makesure stream closed, not close if download aborted.
        deleteFile(file_name);
      });
    })();
  }).listen(8080, function () {
    console.log('app listening on port 8080!');
  });


const deleteFile = (file) => {
  fs.unlink(file, (err) => {
    if (err) {
      console.error(err.toString());
    } else {
      console.warn(file + ' deleted');
    }
  });
}