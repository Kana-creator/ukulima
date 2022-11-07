

$(() => {
    const user_name = document.getElementById("user_name");
    const password = document.getElementById("password");
    const show_password = document.getElementById("show_password");
    const input_array = [user_name, password];


    // FUNCTION FOR SHOWING ERRROR MESSAGE
    const show_error = (input) => {
        const form_group = input.parentElement;
        form_group.classList.add("active");
    }


    const show_success = (input) => {
        const form_group = input.parentElement;
        form_group.classList.remove("active");
    }
        

    // FUNCNTION FOR CHECKING EMPTY FIELDS
    const check_required = (inputArr) => {
        inputArr.forEach(element => {
            if (element.value.length === 0) {
                show_error(element);
            } else {
                show_success(element)
            }

        });
    }


    // SHOWING REQUIRED FIELDS ON TEXT INPUT
    input_array.forEach(input => {
        input.addEventListener('keyup', () => {
            check_required(input_array);
        })
    })


    // SHOWING AND HIDDING PASSWORD 
    $("#show_password").on('click', () => {
        if (password.type === "password") {
            password.type = "text"; 
            show_password.classList.remove("fa-eye");
            show_password.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            show_password.classList.add("fa-eye");
            show_password.classList.remove("fa-eye-slash");
        }
    })

    
// LOGINGING IN BUTTON CLICK
    $("#sign_in_btn").on('click', (e) => {
        if (user_name.value.trim() === "" && password.value.trim() === "") {
            check_required(input_array);
        } else {
            $.ajax({
                url: "./theme/APIs/login_api.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    action: "login",
                    user_name: user_name.value,
                    password: password.value,
                }, 
                Cache: false,
                success: (res) => {
                    alert(res['message']);
                    if (res['status'] === 'success') {
                        if (res['user_type'] === "consumer") {                            
                            window.location.href = "theme/pages/consumer_page.php";
                        } else if (res['user_type'] === "producer") {                            
                            window.location.href = "theme/pages/products.php";
                        } else if (re['user_type'] === "supplier") {                            
                            window.location.href = "theme/pages/products.php";
                        } else if (res['user_type'] === "admin") {                            
                            window.location.href = "theme/pages/home.php";
                        } else if (res['user_type'] === "supper_admin") {                            
                            window.location.href = "theme/pages/system_settings.php";
                        }
                    }
                },
            })
        }

        e.preventDefault();
    })
})