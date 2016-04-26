(function () {

  'use strict';
  var gametitle = function () {

  };

  gametitle.prototype = {
    create: function () {
      console.log('%c Title screen ', 'color: white; background:blue;');

      var gametitle = this.game.add.button(this.game.world.centerX, this.game.world.centerY, 'letsgo', this.startGame, this);
      gametitle.anchor.setTo(0.5);

      /*this.version = this.add.text(10, 10, 'v341', {
        font: '12px Arial',
        fill: '#000000',
        align: 'left'
      });*/
    },
    startGame: function () {
      this.game.state.start('Game');
    }
  };

  window['paddling'] = window['paddling'] || {};
  window['paddling'].gametitle = gametitle;

})();