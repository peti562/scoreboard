var goal = {
    minute : 35,
    scorer: {
        team: 'Spain',
        player: 'Hierro'
    }
};

function getLastGoalData() {

};

function getGoalScorer() {
    getLastGoalData();
    return goal.scorer.player;
}

function getGoalMinute() {
    return goal.minute;
}

function getGoalTeam() {
    return goal.scorer.team;
}