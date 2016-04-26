(function () {
    'use strict';

    var preload = function () {
        this.ready = false;
    };

    preload.prototype = {
        preload: function () {
            console.log('%c Preloading assets ', 'color: white; background:red;');

            this.load.onLoadComplete.addOnce(this.onLoadComplete, this);
            this.loadResources();

            $(".loader").addClass("visible");

            /*var loadingBar = this.add.sprite(this.game.world.centerX,this.game.world.centerY,"loading");
            loadingBar.anchor.setTo(0.5,0.5);
            this.load.setPreloadSprite(loadingBar);*/
        },
        loadResources: function () {
            if(this.game.isWinTablet) {
                this.game.load.spritesheet('road', 'img/games/paddling/water_spritesheet_retexture.jpg', 888, 340);
            } else {
                this.game.load.spritesheet('road', 'img/games/paddling/water_spritesheet_v5.jpg', 1024, 392);
            }

            this.game.load.spritesheet('sail', 'img/games/paddling/Paddling_21frames_spritesheet_v3.png', 129, 240);
            this.game.load.spritesheet('points', 'img/games/paddling/points.png', 76, 107);
            this.game.load.spritesheet('iceberg1', 'img/games/paddling/icebergA.png', 253, 315);
            this.game.load.spritesheet('iceberg2', 'img/games/paddling/icebergB.png', 269, 281);
            this.game.load.spritesheet('iceberg3', 'img/games/paddling/icebergC.png', 188, 248);
            this.game.load.spritesheet('iceberg4', 'img/games/paddling/icebergD.png', 219, 271);
            this.game.load.image('sky', 'img/games/paddling/sky.jpg');
            this.game.load.image('mountain', 'img/games/paddling/mountain.png');
            this.game.load.image('ice1', 'img/games/paddling/ice1.png');
            this.game.load.image('ice2', 'img/games/paddling/ice2.png');
            this.game.load.image('trail', 'img/games/paddling/trail.png');
            this.game.load.image('scorebg', 'img/games/paddling/pointsback.png');

            this.game.load.image('letsgo', 'img/games/CTA.png');
        },
        create: function () {},
        update: function () {
            if (!!this.ready) {
                this.game.state.start('GameTitle');
            }
        },

        onLoadComplete: function () {
            this.ready = true;
            $(".loader").removeClass("visible");
        }
    };

    window['paddling'] = window['paddling'] || {};
    window['paddling'].preload = preload;

})();