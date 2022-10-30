

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


    //  $("#show-user-details").on('click', function () {
    //     $("#product-details").addClass("show");
    //  })
    
    $("#close-user").on('click', () => {
        $("#user-details").removeClass("show");
    })

})