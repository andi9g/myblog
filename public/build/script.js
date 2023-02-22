$('.page-scroll').click( function(e){

    var tujuan = $(this).attr('href');
    var elemenTujuan = $(tujuan);
    
    console.log('ok');

    $('body').animate({
        scrollTop: elemenTujuan.offSet().top 
    },1000,'swing');

    e.preventDefault();
});