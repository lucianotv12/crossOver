//Function called the first time the user click on Play
var game;
var initGame = function(){

    //Codes from the game to init it
    var ns = window['paddling'];

    game = new Phaser.Game(1024, 540, Phaser.AUTO, 'phaser-paddling', null, true);
    game.state.add('Boot', ns.boot);
    game.state.add('Preload', ns.preload);
    game.state.add('GameTitle', ns.gametitle);
    game.state.add('Game', ns.game);

    game.state.start('Boot');

    game.isWinTablet = is_win_tablet();

    //Reset the game so it is visible
    resetGame();

    function is_win_tablet() {
      return (navigator.userAgent.toLowerCase().indexOf("windows nt") != -1 &&
        navigator.userAgent.toLowerCase().indexOf("touch") != -1);
    }

    function is_winphone() {
      return (navigator.userAgent.toLowerCase().indexOf("windows phone") != -1);
    }
    
};

//Function called to reset the game
var resetGame = function(){

    //If we are on a mobile
    if(isMobile){
        $(".canvasGame").show();//Show the canvas
    }
    else{
        $(".teaserGame").removeClass("showOutro howToOn").addClass("gameOn");
    }

};


//Function called whenever the player lose the game
var gameOver = function(grade, score){

    //Change the copy on the outro pannel
    //Three var needs to be passed
    //grade = "gold", "silver", "bronze" or "none"
    //score = score of the player convert in correct unit
    pages.activities.showScores(grade, score);

    $(".teaserGame").removeClass("gameOn").addClass("showOutro");

    if(isMobile){
        $(".canvasGame").hide();//Hide the canvas
        $(window).scrollTop($(".teaserGame").offset().top);//Scroll to the outro
    }

    game.state.start('GameTitle');
};