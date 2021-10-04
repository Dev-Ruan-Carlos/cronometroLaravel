@extends('layouts.app')
@section('body')   
    <div class="fundoazul">
        <div class="botoes white flex-jc">
            <input type="button" class="boton white" id="inicio" value="Iniciar" onclick="inicio();">
            <input type="button" class="boton white" id="parar" value="Parar" onclick="parar();" disabled>
            <input type="button" class="boton white" id="continuar" value="Reiniciar" onclick="inicio();" disabled>
            <input type="button" class="boton white" id="reinicio" value="Resetar" onclick="reinicio();" disabled>
            <a href="{{route('gravar')}}">
                <input type="button" class="boton white" id="reinicio" value="Nova volta" onclick="reinicio();">
            </a>
            <input type="button" class="boton white" id="reinicio" value="Limpar volta" onclick="reinicio();">
        </div>
        <div class="contador white flex-jc" name="contador">
            <div class="reloj white input-horas flex-ae" value=" 00" name="minutos" id="Minutos"></div>
            <div class="reloj white input-horas flex-ae" value=":00" name="segundos" id="Segundos"></div>
            <div class="reloj white input-horas flex-ae" value=":00" name="centesímas" id="Centesimas"></div>
            {{-- <input type="text" name="cronometro" id="cronometro"> --}}
        </div>
    </div>
<script>
var centesimas = 0;
var segundos = 0;
var minutos = 0;
function inicio () {
    control = setInterval(cronometro,10);
    document.getElementById("inicio").disabled = true;
    document.getElementById("parar").disabled = false;
    document.getElementById("continuar").disabled = true;
    document.getElementById("reinicio").disabled = false;
}
function parar () {
    clearInterval(control);
    document.getElementById("parar").disabled = true;
    document.getElementById("continuar").disabled = false;
}
function reinicio () {
    clearInterval(control);
    centesimas = 0;
    segundos = 0;
    minutos = 0;
    Centesimas.innerHTML = ":00";
    Segundos.innerHTML = ":00";
    Minutos.innerHTML = "00";
    document.getElementById("inicio").disabled = false;
    document.getElementById("parar").disabled = true;
    document.getElementById("continuar").disabled = true;
    document.getElementById("reinicio").disabled = true;
}
function cronometro () {
    if (centesimas < 99) {
        centesimas++;
        if (centesimas < 10) { centesimas = "0"+centesimas }
        Centesimas.innerHTML = ":"+centesimas;
    }
    if (centesimas == 99) {
        centesimas = -1;
    }
    if (centesimas == 0) {
        segundos ++;
        if (segundos < 10) { segundos = "0"+segundos }
        Segundos.innerHTML = ":"+segundos;
    }
    if (segundos == 59) {
        segundos = -1;
    }
    if ( (centesimas == 0)&&(segundos == 0) ) {
        minutos++;
        if (minutos < 10) { minutos = "0"+minutos }
        Minutos.innerHTML = ""+minutos;
    }
    if (minutos == 59) {
        minutos = -1;
    }
}
</script>
@endsection 