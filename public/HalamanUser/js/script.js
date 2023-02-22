var coba = "";
$(".scrollpage").on('click', function(e) {


    var tujuan = $(this).attr('href');

    var elemenTujuan = $(tujuan);
    var tujuan2 = elemenTujuan.offset().top;


    if (tujuan2 <= 100) {
        $('html, body').animate({
            scrollTop: tujuan2 - 50
        }, 1000, 'swing');
    } else {
        $('html, body').animate({
            scrollTop: tujuan2 + 20
        }, 1000, 'swing');
    }


    e.preventDefault();
});



window.onscroll = function() { myFunction() };
window.onload = function() { myFunction() };


var visidanmisi = $('#visidanmisi').offset().top - 250;
var struktur = $('#struktur').offset().top - 250;
var dokumentasi = $('#dokumentasi').offset().top - 250;
var pendaftaran = $('#pendaftaran').offset().top - 250;
var linimasa = $('#linimasa').offset().top - 250;
var kontak = $('#kontak').offset().top - 250;
var kritikdansaran = $('#kritikdansaran').offset().top - 250;
var beranda = $('#beranda').offset().top - 250;
var home = $('#kritikdansaran').offset().top - 250;



function myFunction() {
    if (pageYOffset >= beranda && pageYOffset < visidanmisi) {
        $('.beranda').addClass('activeku');
        $('.profileku').removeClass('activeku');
        $('.visidanmisi').removeClass('activeku');
        $('.struktur').removeClass('activeku');
        $('.kritikdansaran').removeClass('activeku');
        $('.dokumentasi').removeClass('activeku');
        $('.pendaftaran').removeClass('activeku');
        $('.formMenu').removeClass('activeku');
        $('.linimasa').removeClass('activeku');
        $('.kontak').removeClass('activeku');
    } else if (pageYOffset >= visidanmisi && pageYOffset < struktur) {
        $('.visidanmisi').addClass('activeku');
        $('.profileku').addClass('activeku');
        $('.struktur').removeClass('activeku');
        $('.kritikdansaran').removeClass('activeku');
        $('.beranda').removeClass('activeku');
        $('.dokumentasi').removeClass('activeku');
        $('.pendaftaran').removeClass('activeku');
        $('.formMenu').removeClass('activeku');
        $('.linimasa').removeClass('activeku');
        $('.kontak').removeClass('activeku');
    } else if (pageYOffset >= struktur && pageYOffset < dokumentasi) {
        $('.struktur').addClass('activeku');
        $('.profileku').addClass('activeku');
        $('.visidanmisi').removeClass('activeku');
        $('.kritikdansaran').removeClass('activeku');
        $('.beranda').removeClass('activeku');
        $('.dokumentasi').removeClass('activeku');
        $('.pendaftaran').removeClass('activeku');
        $('.formMenu').removeClass('activeku');
        $('.linimasa').removeClass('activeku');
        $('.kontak').removeClass('activeku');
    } else if (pageYOffset >= dokumentasi && pageYOffset < pendaftaran) {
        $('.struktur').removeClass('activeku');
        $('.profileku').removeClass('activeku');
        $('.visidanmisi').removeClass('activeku');
        $('.kritikdansaran').removeClass('activeku');
        $('.beranda').removeClass('activeku');
        $('.dokumentasi').addClass('activeku');
        $('.pendaftaran').removeClass('activeku');
        $('.formMenu').removeClass('activeku');
        $('.linimasa').removeClass('activeku');
        $('.kontak').removeClass('activeku');
    } else if (pageYOffset >= pendaftaran && pageYOffset < linimasa) {
        $('.struktur').removeClass('activeku');
        $('.profileku').removeClass('activeku');
        $('.visidanmisi').removeClass('activeku');
        $('.kritikdansaran').removeClass('activeku');
        $('.beranda').removeClass('activeku');
        $('.dokumentasi').removeClass('activeku');
        $('.pendaftaran').addClass('activeku');
        $('.formMenu').addClass('activeku');
        $('.linimasa').removeClass('activeku');
        $('.kontak').removeClass('activeku');
    } else if (pageYOffset >= linimasa && pageYOffset < kritikdansaran) {
        $('.struktur').removeClass('activeku');
        $('.profileku').removeClass('activeku');
        $('.visidanmisi').removeClass('activeku');
        $('.kritikdansaran').removeClass('activeku');
        $('.beranda').removeClass('activeku');
        $('.linimasa').addClass('activeku');
        $('.dokumentasi').removeClass('activeku');
        $('.pendaftaran').removeClass('activeku');
        $('.formMenu').removeClass('activeku');
        $('.kontak').removeClass('activeku');
    } else if (pageYOffset >= kritikdansaran && pageYOffset < kontak) {
        $('.kritikdansaran').addClass('activeku');
        $('.visidanmisi').removeClass('activeku');
        $('.struktur').removeClass('activeku');
        $('.profileku').removeClass('activeku');
        $('.beranda').removeClass('activeku');
        $('.dokumentasi').removeClass('activeku');
        $('.pendaftaran').removeClass('activeku');
        $('.formMenu').addClass('activeku');
        $('.linimasa').removeClass('activeku');
        $('.kontak').removeClass('activeku');

    } else if (pageYOffset >= kontak && pageYOffset > kritikdansaran) {
        $('.kritikdansaran').removeClass('activeku');
        $('.visidanmisi').removeClass('activeku');
        $('.struktur').removeClass('activeku');
        $('.profileku').removeClass('activeku');
        $('.beranda').removeClass('activeku');
        $('.dokumentasi').removeClass('activeku');
        $('.pendaftaran').removeClass('activeku');
        $('.formMenu').removeClass('activeku');
        $('.linimasa').removeClass('activeku');
        $('.kontak').addClass('activeku');
    }

}