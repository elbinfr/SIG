/*
* GET TOTAL AMOUNT OF ARRAY
 */
function getTotalAmount(data){
    var total_amount = 0;

    data.forEach(function(element){
        total_amount = total_amount + element;
    });

    return total_amount;
}

/*
* GET PERCENT'S ARRAY FROM ARRAY WITH AMOUNT
 */
function getPercentFromArray(data){
    var percent = [];
    var total_amount = getTotalAmount(data);

    data.forEach(function(element){
        var total_item = parseInt(element) / total_amount;
        percent.push(parseFloat(total_item.toFixed(2)));
    });

    return percent;
}

/*
* GENERATE DATA JSON FOR GRAPHIC PIE
 */
function generateDataGraphicPie(data_names, data_amount){
    var data_pie = [];
    var data_percent = getPercentFromArray(data_amount);

    for(var i=0; i < data_names.length; i++){
        data_pie.push({
            name: data_names[i],
            y: data_percent[i]
        });
    }

    return data_pie;

}
