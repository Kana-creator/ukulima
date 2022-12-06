
$(() => {
    const trs = document.querySelectorAll("tr");
    

    const group_name = document.getElementById("group_name");
    const registration_type = document.getElementById("registration_type");
    const registration_number = document.getElementById("registration_number");
    const group_type = document.getElementById("group_type");

    const intput_array = [group_name, registration_number];
    const select_input = [registration_type, group_type];

    // SHOWING ERROR MESSAGES
    const show_error = inputArr => {
        inputArr.forEach(input => {
            const form_group = input.parentElement;
            const error_msg = form_group.querySelector("small");
            if (input.value.trim() === "") {
                error_msg.innerText = "This field is required";
            } else {
                error_msg.innerText = "";
                
            }
        });
    }

    $("#show_group_form").on('click', () => {
        $("#consumer_group_form").addClass("show");
    })


    $("#register_group").on('click', e => {
        e.preventDefault();

        if (group_name.value === "" || registration_type.value === "" || registration_number.value === "" || group_type.value === "") {
            show_error(intput_array.concat(select_input));
        } else {
            $.ajax({
                url: "../APIs/consumer_group_api.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    action: "register_group",
                    group_name: group_name.value,
                    registration_type: registration_type.value,
                    registration_number: registration_number.value,
                    group_type: group_type.value
                },
                Cache: false,
                success: res => {
                    alert(res[0]);
                }
            })
        }
    })

    trs.forEach(tr => {
       tr.addEventListener('mouseover', function () {
            this.classList.add("active");
       }) 
        
        tr.addEventListener('mouseout', function () {
            this.classList.remove("active");
        }) 
    })


    //  $("#show-user-details").on('click', function () {
    //     $("#product-details").addClass("show");
    //  })
    
    $("#close-user").on('click', () => {
        $("#user-details").removeClass("show");
    })
})