
$(() => {

    const phone_number = document.getElementById("phone_number");
    const savings_amount = document.getElementById("savings_amount");
    const savings_date = document.getElementById("savings_date");
    const brought_phone_number = document.getElementById("brought_phone_number");
    const brought_full_name = document.getElementById("brought_full_name");

    const input_array = [phone_number, savings_amount, savings_date, brought_full_name, brought_phone_number];

    // FUNCTION FOR SHOWING ERROR MESSAGE
    const show_error = input => {
        const form_group = input.parentElement;
        const small = form_group.querySelector("small");
        small.innerText = "This field is required";
        form_group.classList.add("show");
    }

    // FUNCTION FOR REMOVING ERROR MESSAGE
    const show_success = input => {
        const form_group = input.parentElement;
        const small = form_group.querySelector("small");
        small.innerText = "";
        form_group.classList.remove("show");
    }


    // FUNCTION FOR CHECKING REQUIRED FIELDS
    const check_required = inputArr => {
        inputArr.forEach(element => {
            if (element.value.trim() === "") {
                show_error(element);
            } else {
                show_success(element);
            }
        });
    }



    $("#add_saving").on('click', () => {
        $("#user-details").addClass("show");

    });
                    
    
    $("#close-user").on('click', () => {
        $("#user-details").removeClass("show");
    });

    $("#save_saving").on('click', e => {
        e.preventDefault();
        if (phone_number.value.trim() === "" || savings_amount.value.trim() ==="" || savings_date.value.trim() ==="" || brought_full_name.value.trim() ==="" || brought_phone_number.value.trim() ==="") {
        check_required(input_array);
        } else {
            $.ajax({
                url: "../APIs/loans_api.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    action: "save_saving",
                    phone_number: phone_number.value,
                    savings_amount: savings_amount.value,
                    savings_date: savings_date.value,
                    brought_full_name: brought_full_name.value,
                    brought_phone_number: brought_phone_number.value
                },
                cache: false,
                success: res => {
                    alert(res['msg']);
                    if (res['status'] === "success") {
                        window.location.href = "../pages/loans.php";
                    }
                }
            })

        }
    });
})