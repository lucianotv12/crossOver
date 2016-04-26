(function () {
  'use strict';

  var boot = function () {
    console.log('%c Booting game ', 'color: white; background:red;');
  };

  boot.prototype = {
    preload: function () {

    },
    create: function () {
      if (this.game.device.desktop) {
        this.game.scale.pageAlignHorizontally = true;
        this.game.scale.pageAlignVertically = true;
      } else {
        this.game.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
        
        this.game.scale.pageAlignHorizontally = true;
        this.game.scale.pageAlignVertically = true;
        this.game.scale.forceOrientation(false, false);
        this.game.scale.compatibility.scrollTo = false;
      }

      this.game.state.start('Preload');
    }
  };

  window['paddling'] = window['paddling'] || {};
  window['paddling'].boot = boot;

})();