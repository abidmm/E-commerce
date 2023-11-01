document.addEventListener('DOMContentLoaded', function () {

    //getting all form using class (cause of multiple forms at a time)
    const cartform = document.querySelectorAll('.add-cart');


    function formsubmition(event) {
        event.preventDefault();
        //getting submitted form
        const form = event.target;
        //extracting input data from submitted form
        const data = new FormData(form);

        // sending request to route(form.action) with details
        fetch(form.action, {
            method: 'POST',
            body: data,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })

            //getting the response and converting response to json
            .then((res) => res.json())
            //manipulating the output using json response after submission
            .then((ress) => {
                if (ress.status) {
                    alert(ress.message)
                    location.reload();
                }
                else {
                    alert(ress.message)
                }

            })
    }

    //adding event listner to each of the form (looping multiple form)
    cartform.forEach(form => {
        form.addEventListener('submit', formsubmition);
    });

})

