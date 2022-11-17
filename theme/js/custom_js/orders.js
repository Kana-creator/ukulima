

$(() => {
    const trs = document.querySelectorAll("tr");

    
    trs.forEach(tr => {
       tr.addEventListener('mouseover', function () {
            this.classList.add("active");
       }) 
        
        tr.addEventListener('mouseout', function () {
            this.classList.remove("active");
        }) 
    })

    $("#clear_order").on('click', () => {
        $.ajax({
            url: "../APIs/orders_api.php",
            type: "POST",
            dataType: "JSON",
            data: {
                action: "clear_order",
                order_id: $("#input_order_id").val(),
            },
            Cache: false,
            success: res => {
                alert(res['message']); 
                window.location.href = "../pages/orders.php";
            }
        });
    });
});