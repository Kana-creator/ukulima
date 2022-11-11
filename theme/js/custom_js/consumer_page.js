

$(() => {

    const serial_number = document.getElementById("input_serial_number");
    const verification_message = document.getElementById("verification_message");

    $("#verify_product").on('click', function (e) {

        if (serial_number.value.trim() === "") {
            verification_message.innerText = "Please enter product serial number to verify!";
        } else {
            $.ajax({
                url: "../APIs/consumer_page_api.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    action: "verify_product",
                    serial_number: serial_number.value,
                },
                Cache: false,
                success: res => {
                    if (res['status'] === "success") {
                        $("#product-details").addClass("show");
                        verification_message.innerText = "";
                        $("#product_image").attr("src", "../assets/product_images/"+res['product_image']);
                        $("#p_brand_name").text(res['brand_name']);
                        $("#p_manufacturer").text(res['manufacturer']);
                        $("#p_supplier").text(res['supplier']);
                        $("#p_point_of_origin").text(res['point_of_origin']);
                        $("#p_date_of_manufacture").text(res['date_of_manufacture']);
                        $("#p_expiry_date").text(res['expiry_date']);
                        $("#p_unit_of_measure").text(res['unit_of_measure']);
                        $("#p_batch_number").text(res['batch_number']);
                        $("#p_serial_number").text(res['serial_number']);
                        $("#p_unit_cost").text("Ugx. "+res['unit_cost']+"/=");
                        $("#p_user_guid").text(res['user_guid']);
                    } else {
                        verification_message.innerText = res['message'];
                    
                    }
                },
            })
        }

        e.preventDefault();
    });

    $("#close-user").on('click', () => {
        $("#product-details").removeClass("show");
    });


});