<?php

namespace App\Notifications;

use App\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

/**
 * Class ArticlePublished
 * @package App\Notifications
 */
class ArticlePublished extends Notification
{
  use Queueable;

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return [FacebookPosterChannel::class];
  }

  /**
   * @param $blog
   */
  public function toFacebookPoster($text)
  {
    $image_path = url('images/generator/team_players/senegal.png');
    return with(new FacebookPosterPost('Testing automatic posting to facebook'))
      ->withImage($image_path);
  }
}