/* ------------------------------------------------------------------------------
 *
 *  # Dashboard configuration
 *
 *  Demo dashboard configuration. Contains charts and plugin inits
 *
 *  Version: 1.0
 *  Latest update: Aug 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function() {    

    // Switchery toggles
    // ------------------------------

    //var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
    //switches.forEach(function(html) {
    //    var switchery = new Switchery(html, {color: '#4CAF50'});
    //});
    
    
    initView();

    function initView(){
        $('.orderPeriod span, .transactionPeriod span').html(moment().startOf('month').format('DD.MM.YYYY') + ' - ' + moment().format('DD.MM.YYYY'));
        initEvents();
        
    }

    function initEvents(){
        // Daterange picker
        // ------------------------------
        $('.orderPeriod').daterangepicker(
            {
                startDate: moment().startOf('month'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2020',
                dateLimit: { days: 60 },
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                    'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                    'В этом месяце': [moment().startOf('month'), moment().endOf('month')],
                    'В прошлом месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                applyClass: 'btn-small bg-slate-600 btn-block',
                cancelClass: 'btn-small btn-default btn-block',
                format: 'MM/DD/YYYY'
            },
            function(start, end) {
                var period=start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY');
                $('.orderPeriod span').html(period);
                
                $('#order-search-form #date-begin').val(start.format('X'));
                $('#order-search-form #date-end').val(end.format('X'));
                
                var data=$('#order-search-form').serialize();

                $('#order-spinner').html('<div><i class="icon-spinner2 spinner"></i><div>');
                $('#order-items').html('');


                
                $.ajax({
                    type: 'POST',
                    url: '/',
                    data:data,
                    success:function(data){

                      $('#panel-orders').html(data);
                      $('.orderPeriod span').html(period);

                      initEvents();
                    },
                    error: function(data) { // if error occured
                      console.log("Error occured.please try again");
                    },
                    dataType:'html'
                });
                
            }
            
        );

        $('.transactionPeriod').daterangepicker(
            {
                startDate: moment().startOf('month'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2020',
                dateLimit: { days: 60 },
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                    'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                    'В этом месяце': [moment().startOf('month'), moment().endOf('month')],
                    'В прошлом месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                applyClass: 'btn-small bg-slate-600 btn-block',
                cancelClass: 'btn-small btn-default btn-block',
                format: 'MM/DD/YYYY'
            },
            function(start, end) {
                //$('.transactionPeriod span').html(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
                var period=start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY');
                $('.transactionPeriod span').html(period);
                
                $('#transaction-search-form #date-begin').val(start.format('X'));
                $('#transaction-search-form #date-end').val(end.format('X'));
                
                var data=$('#transaction-search-form').serialize();

                $('#transaction-spinner').html('<div><i class="icon-spinner2 spinner"></i><div>');
                $('#transaction-items').html('');


                
                $.ajax({
                    type: 'POST',
                    url: '/',
                    data:data,
                    success:function(data){

                      $('#panel-transactions').html(data);
                      $('.transactionPeriod span').html(period);

                      initEvents();
                    },
                    error: function(data) { // if error occured
                      console.log("Error occured.please try again");
                    },
                    dataType:'html'
                });
            }
        );

    }

});
