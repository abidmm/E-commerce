document.addEventListener('DOMContentLoaded', function () {

    const updateform = document.querySelectorAll('.update-cart');
    const deleteform = document.querySelectorAll('.deletecart');
    const checkout = document.getElementById('checkout');



    function cartEvents(event) {
        event.preventDefault();
        //getting submitted form
        const tempform = event.target;
        //extracting input data from submitted form
        const data = new FormData(tempform);

        //hide delete button($(this) gets the submitted form and find the deletebtn class within the submitted form)
        var dltbutton = $(this).find('.deletebtn')
        dltbutton.addClass('hidden')

        //hide checkout button($(this) gets the submitted form and find the checkout-btn id within the submitted form)
        var checkoutbtn = $(this).find('#checkout-btn')
        checkoutbtn.addClass('hidden')

        //sending request to route(form.action  gets the value of action attribute from the submitted form) with details
        fetch(tempform.action, {
            method: 'POST',
            body: data,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
            //getting the response and converting response to json
            .then((res) => res.json())
            //manipulating the output using json response after submission
            .then((result) => {
                console.log(result)
                if (result.status) {
                    alert(result.message)
                    location.reload();
                    // setTimeout(function() {
                    //     location.reload();
                    // }, 5000);
                }
                else {
                    alert(result.message)
                    checkoutbtn.removeClass('hidden')
                    dltbutton.removeClass('hidden')
                }
            })
    }

    //adding event listner to each of the form (looping multiple form)
    updateform.forEach(element => {
        element.addEventListener('submit', cartEvents);
    });

    //adding event listner to each of the form (looping multiple form)
    deleteform.forEach(element => {
        element.addEventListener('submit', cartEvents);
    })

    checkout.addEventListener('submit', cartEvents);

})