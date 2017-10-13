/*
* SEARCH ITEM IN ARRAY
 */
function getIndexArray(search, data){
    var index_found = -1;
    data.forEach(function(element, index){
        if(search === element){
            index_found = index;
            return true;
        }
    });

    return index_found;
}

/*
* GET COB'S NAME
 */
function getCobName(name){
    var index = name.indexOf("cob");
    var cob_name = name.substring(index);

    return cob_name;
}

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
        percent.push(parseFloat(total_item.toFixed(3)));
    });

    return percent;
}

/*
* GENERATE DATA JSON FOR GRAPHIC PIE
 */
function generateDataGraphicPie(data_names, data_amount, data_colors){
    var data_pie = [];
    var data_percent = getPercentFromArray(data_amount);

    for(var i=0; i < data_names.length; i++){
        data_pie.push({
            name: data_names[i],
            y: data_percent[i],
            color: data_colors[i]
        });
    }

    return data_pie;

}

/*
* SHOW LIST ERRORS IN SWEETALERT
* @error_list: array with errors mesage
 */
function showErrorList(error_list){
    var message = '';
    $.each(error_list, function(index, item) {
        $.each(item, function(index1, error) {
            message = message + '<li>'+error+'</li>';
        });
    });

    swal({
        type: "error",
        title: "Error!",
        html: true,
        text: '<ul style="text-align: left;">'+message+'</ul>'
    });
}
