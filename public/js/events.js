
    var filter;

    $(".chkb").click(function(){
        filter = $('input:radio[name=rbFiltro]:checked').val();

        if(filter == 'M'){
            $(".smonth").removeClass('hidden');
            $(".sdate").addClass('hidden');
        }else{
            $(".sdate").removeClass('hidden');
            $(".smonth").addClass('hidden');
        }
    });