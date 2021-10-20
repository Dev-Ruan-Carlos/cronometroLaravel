@extends('layouts.app')
@section('body')  
    <div class="fundoazul">
        <div class="flex-jc flex-jb pt-3">
            <button type="button" id="toggle" class="boton">Iniciar</button>
            <button type="button" id="reset" class="boton ml-2">Resetar</button>
            <a href="javascript:void(0)" onclick="gravar(this)">
                <button type="button" id="novavolta" class="boton ml-2" >Nova volta</button>
            </a>
            <a href="javascript:void(0)" onclick="cronometroDel()">
                <button type="button" id="limparvolta" class="boton ml-2">Limpar volta</button>
            </a>
        </div>
        <div class="flex-jc pt-17">
            <span id="timer" name="timer" class="white" style="font-size: 80px;">00 : 00 : 000</span>
            <input type="text" name="tempo" id="inputTempo" hidden>
        </div>
        <ul id="voltas" class="white flex-c flex-jc flex-ac pt-3 pb-3" style="font-size: 17px;"></ul>
    </div>
<script>
    var 
        timer = document.getElementById('timer'),
        toggleBtn = document.getElementById('toggle'),
        resetBtn = document.getElementById('reset'),
        watch = new Stopwatch(timer);

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
            console.log(time);
            elem.textContent = timeFormatter(time);
            input.value = time;
        }

        function delta() {
            var now = Date.now();
            var timePassed = now - offset;

            offset = now;

            return timePassed;
        }

        this.timeFormatter = function(time) {
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

        function timeFormatter (time) {
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
    
    function gravar(el){
        var 
            tempo = document.getElementById('inputTempo').value
        $.ajax({
            url: "{{route('gravar')}}",
            type: "post",
            data: {
                tempo: tempo
            },
            success: function( data ){
                var li = document.createElement('li');
                li.textContent = watch.timeFormatter(parseInt(tempo));
                li.dataset.id = data.id;
                document.getElementById('voltas').appendChild(li);
            },
            beforeSend: function(request){
                request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
            }
        });
    }

    function cronometroDel(){
        var 
            voltas = [];

        document.querySelectorAll('#voltas li').forEach(element => {
            voltas.push(element.dataset.id)
        });
            
        if(voltas.length == 0)
            return;
        
        $.ajax({
            url: "{{route('delete', '_voltas_')}}".replace('_voltas_', encodeURI(voltas)),
            type: 'DELETE',
            
            success: function( data ){
                document.getElementById('voltas').innerHTML = ''
            },
            beforeSend: function(request){
                request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
            }
        });
    }
</script>
@endsection 