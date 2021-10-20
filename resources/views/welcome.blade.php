@extends('layouts.app')
@section('body')   
<form action="{{route('gravar')}}" method="POST">
    @method('POST')
    @csrf
    <div class="fundoazul">
        <div class="flex-jc flex-jb pt-3">
          <button type="button" id="toggle" class="boton">Iniciar</button>
          <button type="button" id="reset" class="boton ml-2">Resetar</button>
              <button type="submit" id="novavolta" class="boton ml-2">Nova volta</button>
              <button type="button" id="limparvolta" class="boton ml-2">Limpar volta</button>
        </div>
        <div class="flex-jc pt-17">
            <span id="timer" name="timer" class="white" style="font-size: 80px;">00 : 00 : 000</span>
            <input type="text" name="tempo" id="inputTempo" hidden>
        </div>
    </div>
</form>
<script>
    var timer = document.getElementById('timer');
    var toggleBtn = document.getElementById('toggle');
    var resetBtn = document.getElementById('reset');

    var watch = new Stopwatch(timer);

    function start() {
        toggleBtn.textContent = 'Parar';
        watch.start();
    }

    function stop() {
        toggleBtn.textContent = 'Reiniciar';
        watch.stop();
    }

    toggleBtn.addEventListener('click', function() {
        watch.isOn ? stop() : start();
    });

    resetBtn.addEventListener('click', function() {
        watch.reset();
    });

    function Stopwatch(elem) {
        var time = 0;
        var offset;
        var interval;
        var input = document.getElementById('inputTempo');

        function update() {
            if (this.isOn) {
            time += delta();
            }
            
            elem.textContent = timeFormatter(time);
            input.value = time;
        }

        function delta() {
            var now = Date.now();
            var timePassed = now - offset;

            offset = now;

            return timePassed;
        }

        function timeFormatter(time) {
            time = new Date(time);

            var minutes = time.getMinutes().toString();
            var seconds = time.getSeconds().toString();
            var milliseconds = time.getMilliseconds().toString();

            if (minutes.length < 2) {
            minutes = '0' + minutes;
            }

            if (seconds.length < 2) {
            seconds = '0' + seconds;
            }

            while (milliseconds.length < 3) {
            milliseconds = '0' + milliseconds;
            }

            return minutes + ' : ' + seconds + ' : ' + milliseconds;
        }

        this.start = function() {
            interval = setInterval(update.bind(this), 10);
            offset = Date.now();
            this.isOn = true;
        };

        this.stop = function() {
            clearInterval(interval);
            interval = null;
            this.isOn = false;
        };

        this.reset = function() {
            time = 0;
            update();
        };

        this.isOn = false;
    }
</script>
@endsection 