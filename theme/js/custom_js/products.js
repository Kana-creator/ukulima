
$(() => {

    const brand_name = document.getElementById("val-brand-name").value;
    const product_manufacturer = document.getElementById("val-manufacturer").value;
    const product_supplier = document.getElementById("val-supplier").value;
    const point_of_origin = document.getElementById("val-point-of-origin").value;
    const date_of_manufacture = document.getElementById("val-date-of-manufacture").value;
    const expiry_date = document.getElementById("val-date-of-expiry").value;
    const product_image = document.getElementById("val-product-image").value;
    const unit_of_measure = document.getElementById("val-unit-of-measure").value;
    const batch_number = document.getElementById("val-batch-number").value;
    const serial_number = document.getElementById("val-serial-number").value;
    // const unit_cost = document.getElementById("val-unit-cost").value;
    const user_guid = document.getElementById("val-e-extension").value;

    var input_array = [brand_name, product_manufacturer, product_supplier, point_of_origin, date_of_manufacture, expiry_date, product_image, unit_of_measure, batch_number, serial_number, user_guid];

    const show_error = input => {
        const form_group = input.parentElement;
        const small = form_group.querySelector("small");
        small.classList.add("active");
        small.innerText = "This field is required.";
        form_group.classList.add("error");
       
    }

     // removing error message
    const show_success = input => {
        const form_group = input.parentElement;
        const small = form_group.querySelector("small").classList.remove("active");
        const label = form_group.querySelector("label").classList.add("active");
        form_group.classList.remove("error");
    }

    // checking required fields
    const check_required = (inputArray, e) => {
        inputArray.forEach(element => {
            if (element.length === 0) {
                show_error(element);
            } else {
                show_success(element);
            }

        })

    }


    check_required(input_array);

    // showing required fields on text input
    // input_array.forEach(input => {
    //     input.addEventListener('keyup', () => {
    //         check_required(input_array.concat(select_array));
    //     });
    // });


   

    // SUBMITING PRODUCT INFO
    $("#add_product").on('click', (e) => {
        if (brand_name === "" || product_manufacturer === "" || product_supplier === "" || point_of_origin === "" || date_of_manufacture === "" || expiry_date === "" || product_image === ""  || unit_of_measure === "" || batch_number === "" || serial_number === "" || unit_cost === "" || user_guid === "" ) {
            check_required(input_array, e);
            e.preventDefault();
        } else {
            
            e.preventDefault();
        }

    })

    

});
