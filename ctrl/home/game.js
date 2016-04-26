(function () {
  'use strict';

  var game = function () {

    this.icebergs = [];
    this.icebergXCoords = [];
    this.icebergsOnScreen = [];
    this.gameover = false;
    this.currentSpeed = 0;
    this.maxSpeed = 6;
    this.roadWidth = 1024;
    this.carFrameCount = 7;
    this.sailFrameCount = 21;
    this.secondsPerLevel = 20;
    this.ticksPerSecond = 4;
    this.timePlayed = 0;
    this.ticks = 0;
    this.level = 0;
    this.rockXCoords = [];
    this.rockHitSizes = [];
    this.rocktimers = [3, 2, 1.5, 1, 0.5, 0.25];
    this.rocksOnScreen = [];
    this.rocksPassed = 0;
    this.rocks = [];
    this.pointerLeft = false;
    this.pointerRight = false;
    this.roadSpeed = 25;
    this.plusscore = null;
    this.distance = null;
    this.loopTimer = null;
  };

  game.prototype = {
    create: function () {
      if(this.icebergGroup != null){
        this.icebergGroup.destroy();
      }

      this.gameover = false;
      this.plusscore = null;
      this.rockGroup = null;
      this.roadSpeed = 25;
      this.currentSpeed = 0;
      this.maxSpeed = 6;
      this.distance = 0;

      this.icebergs = [];
      this.ticks = 0;
      this.level = 0;

      this.debug = this.getQueryVariable('debug');

      this.initStage();
      this.createControls();
      this.createBackground();
      this.createRoad();
      this.createIce();
      this.createIcebergs();
      this.createEmitters();
      this.createPoints();
      this.createSail();

      this.rocktimer = this.rocktimers[this.level];
      this.loopTimer = this.game.time.events.loop(Phaser.Timer.SECOND / this.ticksPerSecond, this.timer, this);

      this.createUI();
    },
    initStage: function () {
      this.game.physics.startSystem(Phaser.Physics.ARCADE);
      this.game.stage.backgroundColor = '#c6e5f1';
    },
    createControls: function () {
      if (this.game.device.desktop) {
        this.cursors = this.game.input.keyboard.createCursorKeys();
      } else {
        this.game.input.onDown.add(this.handlePointerDown, this);
        this.game.input.onUp.add(this.handlePointerUp, this);
      }
    },
    createBackground: function () {
      this.sky = this.game.add.sprite(this.game.world.centerX, 0, 'sky');

      this.sky.anchor.set(0.5, 0);
      this.sky.scale.set(0.5, 0.5);

      this.game.add.tween(this.sky.scale).to({
          x: 1,
          y: 1
      }, 150000, Phaser.Easing.Linear.None, true, 0, -1, true);

      this.mountain = this.game.add.sprite(0, 120, 'mountain');
    },
    createIce: function () {

      this.ice2 = this.game.add.sprite(this.game.width * 0.35, 190, 'ice2');
      this.ice2.anchor.set(0.5);
      this.ice2.scale.set(0.35);

      this.ice1 = this.game.add.sprite(this.game.width * 0.65, 210, 'ice1');
      this.ice1.anchor.set(0.5);
      this.ice1.scale.set(0.35);

      this.ice1Tween = this.game.add.tween(this.ice1.scale).to({
        x: 1,
        y: 1
      }, 400000, Phaser.Easing.Linear.None, true, 0, -1, true);
      this.ice2Tween = this.game.add.tween(this.ice2.scale).to({
        x: 1,
        y: 1
      }, 300000, Phaser.Easing.Linear.None, true, 0, -1, true);
    },
    createRoad: function () {
      this.road = this.game.add.sprite(0, 205, 'road');

      if(this.game.isWinTablet) {
        this.road.scale.set(1.1531531, 1.1531531);
      }
      
      this.roadSegmentWidth = Math.round(this.roadWidth / this.sailFrameCount);
      this.roadAnim = this.road.animations.add('moving', [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], this.roadSpeed, true);
      this.road.play('moving');
    },
    createSail: function () {
      this.sail = this.game.add.sprite(this.game.world.width / 2, 400, 'sail');
      this.sail.anchor.set(0.5);
      this.game.physics.enable(this.sail, Phaser.Physics.ARCADE);
      this.sail.body.setSize(60, 75, -10, 60);

      this.sail.body.collideWorldBounds = true;
      this.sail.body.bounce.set(1);
      this.sail.body.immovable = true;

      this.zPoint = (this.game.world.width / 2) - (this.roadWidth / 2);

      this.sail.angle = -2;
      this.rockingTween = this.game.add.tween(this.sail).to({
        y: 405
      }, 750, Phaser.Easing.Linear.EaseOut, true, 0, -1, true);
      this.swayingTween = this.game.add.tween(this.sail).to({
        angle: 2
      }, 1250, Phaser.Easing.Linear.EaseOut, true, 0, -1, true);

      this.paddleRight = this.sail.animations.add('paddleRight', [0, 1, 2, 3, 4, 5, 6, 7], 10, true);
      this.paddleLeft = this.sail.animations.add('paddleLeft', [13, 14, 15, 16, 17, 18, 19, 20], 10, true);
      this.switchLeft = this.sail.animations.add('switchLeft', [8, 9, 10, 11, 12], 20, true);
      this.switchRight = this.sail.animations.add('switchRight', [12, 11, 10, 9, 8], 20, true);
      this.paddleStraight = this.sail.animations.add('paddleStraight', [0, 1, 2, 3, 4, 5, 6, 7, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 13, 14, 15, 16, 17, 18, 19, 20, 12, 11, 10, 9, 8], 10, true);

      this.sail.play('paddleStraight');
    },
    createUI: function () {
      this.add.sprite(-80, 13, 'scorebg');

      this.plusscore = this.game.add.text(this.game.world.centerX - 20, 100, '+10', {
        font: '40px bebas-neue',
        fill: '#ffffff',
        align: 'center'
      });
      this.plusscore.alpha = 0;

      this.distance = this.add.text(72, 50, '0', {
        font: '48px bebas-neue',
        fill: '#000000',
        align: 'right'
      });
      this.distance.anchor.setTo(1, 0.5);

      this.add.text(78, 45, 'm', {
        font: '24px bebas-neue',
        fill: '#000000',
        align: 'center'
      });
    },
    timer: function () {
      this.ticks++;
      if (this.ticks % this.ticksPerSecond === 0) {
        this.timePlayed++;
      }

      if (this.distance) {
        this.distance.setText(this.ticks);
      }

      if (this.ticks % (this.secondsPerLevel * this.ticksPerSecond) === 0) {
        this.level++;
        if (this.level === this.rocktimers.length) {
          this.rocktimer = this.rocktimers[this.rocktimers.length - 1];
        } else {
          this.rocktimer = this.rocktimers[this.level];
        }
      }
    },
    createIcebergs: function () {
      this.rocktimer = this.rocktimers[this.level];

      this.icebergs[0] = 'iceberg1';
      this.icebergs[1] = 'iceberg2';
      this.icebergs[2] = 'iceberg3';
      this.icebergs[3] = 'iceberg4';

      this.icebergXCoords[0] = -500;
      this.icebergXCoords[1] = 1600;
      this.icebergXCoords[2] = this.game.world.width / 2;
      this.icebergXCoords[3] = -500;
      this.icebergXCoords[4] = 1600;
      this.icebergXCoords[5] = this.game.world.width / 2;

      this.icebergGroup = this.game.add.group();

      this.game.time.events.add(Phaser.Timer.SECOND * this.rocktimer, this.spawnIceberg, this).autoDestroy = true;
    },
    createEmitters: function () {
      this.trailEmitter = this.game.add.emitter(0, 0);
      this.trailEmitter.makeParticles('trail');
      this.trailEmitter.lifespan = 250;
      this.trailEmitter.minRotation = 0;
      this.trailEmitter.maxRotation = 0;
      this.trailEmitter.setScale(1.5, 4, 1.5, 4, 1000);
      this.trailEmitter.gravity = 1000;
      this.trailEmitter.maxParticleSpeed = new Phaser.Point(0, 50);
      this.trailEmitter.minParticleSpeed = new Phaser.Point(0, 100);
    },
    createPoints: function () {
      this.pointsGroup = this.game.add.group();

      for (var i = 0; i < 5; ++i) {
        var point = this.pointsGroup.create(-2000, -2000, 'points');
        point.animations.add('turn');
        point.animations.play('turn', 15, true);
        this.game.physics.enable(point, Phaser.Physics.ARCADE);
        point.body.setSize(30, 20, 0, 40);
        point.kill();
      }

      this.spawnPoint();
    },
    spawnIceberg: function () {
      if (!this.gameover) {
        var rndTimer = 250 + Math.floor(Math.random() * this.rocktimer) * Phaser.Timer.SECOND;
        this.game.time.events.add(rndTimer, this.spawnIceberg, this).autoDestroy = true;

        var rnd = Math.floor(Math.random() * (this.icebergs.length));
        var rndPos = Math.floor(Math.random() * 2048) - 1024;

        var iceberg = this.icebergGroup.getFirstDead();
        if (iceberg === null) {
          iceberg = this.icebergGroup.create(-2000, -2000, this.icebergs[rnd]);
          this.game.physics.enable(iceberg, Phaser.Physics.ARCADE);
          iceberg.body.setSize((iceberg.texture.width / 3) * 0.75, 75, 0, -40);
        }
        iceberg.revive();

        iceberg.x = this.game.world.centerX + (rndPos / 10);
        iceberg.y = 220;

        iceberg.anchor.setTo(0.5);
        iceberg.scale.set(0.02, 0.02);

        iceberg.animations.add('ripple', [0, 1, 2, 3, 4, 5], 8, true);
        iceberg.play('ripple');

        var icebergScaleTween = this.game.add.tween(iceberg.scale);
        icebergScaleTween.to({
          x: 2,
          y: 2
        }, 13000, this.ultratween, true, 0, 0);
        var icebergYTween = this.game.add.tween(iceberg);
        icebergYTween.to({
          x: this.game.world.centerX + rndPos,
          y: 1000
        }, 13000, this.ultratween, true, 0, 0);

        icebergScaleTween.onComplete.add(function () {
          this.destroyIceberg(iceberg);
        }, this);

        this.icebergsOnScreen.push(iceberg);

        this.icebergGroup.sort('y', Phaser.Group.SORT_ASCENDING);

        /*this.game.world.bringToTop(this.ice2);
        this.game.world.bringToTop(this.ice1);
        this.game.world.bringToTop(this.distance);*/
      }
    },
    destroyIceberg: function (iceberg) {
      this.icebergsOnScreen.splice(0, 1);
      iceberg.kill();
    },
    update: function () {
      if (!this.gameover) {
        if (this.game.device.desktop) {
          if (this.cursors.left.isDown) {
            this.currentSpeed = -this.maxSpeed;

            if (this.sail.animations.currentAnim.name === 'paddleStraight' || this.sail.animations.currentAnim.name === 'paddleLeft') {
              if (this.sail.animations.currentAnim.currentFrame.index <= 10) {
                this.sail.play('paddleRight');
              } else {
                this.sail.play('switchRight');
              }
            } else if (this.sail.animations.currentAnim.name === 'switchRight') {
              if (this.sail.animations.currentAnim.currentFrame.index === 8) {
                this.sail.play('paddleRight');
              }
            }
          } else if (this.cursors.right.isDown) {
            this.currentSpeed = this.maxSpeed;

            if (this.sail.animations.currentAnim.name === 'paddleStraight' || this.sail.animations.currentAnim.name === 'paddleRight') {
              if (this.sail.animations.currentAnim.currentFrame.index > 10) {
                this.sail.play('paddleLeft');
              } else {
                this.sail.play('switchLeft');
              }
            } else if (this.sail.animations.currentAnim.name === 'switchLeft') {
              if (this.sail.animations.currentAnim.currentFrame.index === 12) {
                this.sail.play('paddleLeft');
              }
            } else if (this.sail.animations.currentAnim.name === 'switchRight') {
              if (this.sail.animations.currentAnim.currentFrame.index === 8) {
                this.sail.play('paddleStraight');
              }
            }
          } else {
            this.currentSpeed = this.currentSpeed / 1.1;

            if (this.sail.animations.currentAnim.name === 'paddleRight') {
              this.sail.play('paddleStraight');
            } else if (this.sail.animations.currentAnim.name === 'paddleLeft') {
              this.sail.play('switchRight');
            } else if (this.sail.animations.currentAnim.name === 'switchRight') {
              if (this.sail.animations.currentAnim.currentFrame.index === 8) {
                this.sail.play('paddleStraight');
              }
            } else if (this.sail.animations.currentAnim.name === 'switchLeft') {
              if (this.sail.animations.currentAnim.currentFrame.index === 12) {
                this.sail.play('paddleLeft');
              }
            }
          }
        }

        if (this.pointerLeft) {
          this.currentSpeed = -this.maxSpeed;
        } else if (this.pointerRight) {
          this.currentSpeed = this.maxSpeed;
        } else {
          this.currentSpeed = this.currentSpeed / 1.1;
        }

        var rX;
        var frame;

        this.sail.x += this.currentSpeed;
        rX = this.sail.x - this.zPoint;
        frame = Math.floor(rX / this.roadSegmentWidth);

        for (var i = 0; i < this.icebergsOnScreen.length; i++) {
          this.game.physics.arcade.overlap(this.sail, this.icebergsOnScreen[i], this.overlapHandler, null, this);
        }

        this.pointsGroup.forEachAlive(function (point) {
          this.game.physics.arcade.overlap(this.sail, point, this.pointOverlapHandler, null, this);
        }, this);

        this.trailEmitter.x = this.sail.x - 5;
        this.trailEmitter.y = this.sail.y + 60;
        this.trailEmitter.emitParticle();
        var emitter = this.trailEmitter;
        this.trailEmitter.forEachAlive(function (p) {
          p.alpha = (p.lifespan / emitter.lifespan) / 6;
        });
      }
    },
    spawnPoint: function () {
      if (!this.gameover) {
        var rndTimer = 250 + Math.floor(Math.random() * 20) * Phaser.Timer.SECOND;
        this.game.time.events.add(rndTimer, this.spawnPoint, this).autoDestroy = true;

        var point = this.pointsGroup.getFirstDead();
        if (point) {

          var rnd = Math.floor(Math.random() * 12);
          var rndPos = Math.floor(Math.random() * 2048) - 1024;

          //var px = this.game.world.centerX + (((this.rockXCoords[rnd] / 2) - 700) / 110) ;
          point.x = this.game.world.centerX + (rndPos / 10);;
          point.alpha = 1;
          point.y = 220;

          point.anchor.setTo(0.5);
          point.scale.set(0.01, 0.01);

          var pointScaleTween = this.game.add.tween(point.scale);
          pointScaleTween.to({
            x: 2,
            y: 2
          }, 13000, this.ultratween, true, 0, 0);
          var pointYTween = this.game.add.tween(point);

          pointYTween.to({
            x: this.game.world.centerX + rndPos,
            y: 1000
          }, 13000, this.ultratween, true, 0, 0);

          pointScaleTween.onComplete.add(function () {
            point.kill();
          }, this);
          point.revive();

          //this.game.world.bringToTop(point);
        }
      }
    },
    pointOverlapHandler: function (sail, point) {
      point.kill();

      this.plusscore.alpha = 1;
      this.plusscore.y = 300;
      var plustween = this.game.add.tween(this.plusscore);
      plustween.to({
        y: 250,
        alpha: 0
      }, 2000, Phaser.Easing.Circular.Out, true, 0, 0);

      this.ticks += 10;
    },
    overlapHandler: function () {
      //this.loopTimer.timer.destroy();
      this.game.time.events.remove(this.loopTimer);
      this.gameover = true;
      this.road.animations.stop(null, true);

      this.game.tweens.pauseAll();
      this.sail.animations.stop();

      for (var i = 0; i < this.rocksOnScreen.length; i++) {
        this.icebergsOnScreen[i].animations.stop();
      }
      this.setMedalScore();

    },
    setMedalScore: function(){

      var grade = 'none';
      if (this.ticks > gold) {
        grade = 'gold';
      } else if (this.ticks > silver) {
        grade = 'silver';
      } else if (this.ticks > bronze) {
        grade = 'bronze';
      }

      gameOver(grade, this.ticks);
      
    },
    render: function () {
      if (this.debug === '1') {
        this.game.debug.body(this.sail);
        for (var i = 0; i < this.icebergsOnScreen.length; i++) {
          this.game.debug.body(this.icebergsOnScreen[i]);
        }
      }
    },
    handlePointerDown: function (pointer) {
      if (pointer.x < this.game.width * 0.5) {
        this.pointerLeft = true;
        this.pointerRight = false;
      } else {
        this.pointerLeft = false;
        this.pointerRight = true;
      }
    },
    handlePointerUp: function () {
      this.pointerLeft = false;
      this.pointerRight = false;
    },

    ultratween: function (k) {
      return Math.pow(k, 8);
    },

    getQueryVariable: function (variable) {
      var query = window.location.search.substring(1);
      var vars = query.split('&');
      for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (pair[0] === variable) {
          return pair[1];
        }
      }
      return (false);
    }
  };

  window['paddling'] = window['paddling'] || {};
  window['paddling'].game = game;

})();