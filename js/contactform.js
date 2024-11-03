$(document).ready(function() {
    $('#contactForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Gather form data
        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            subject: $('#subject').val(),
            message: $('#message').val()
        };

        // Send data to the PHP script using Ajax
        $.ajax({
            type: 'POST',
            url: 'php/contact.php', // Use forward slash
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#formResponse').html('<p class="text-success">Thank you for your message. We will get back to you soon!</p>');
                    $('#contactForm')[0].reset(); // Clear the form
                } else {
                    $('#formResponse').html('<p class="text-danger">' + response.message + '</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown); // Logs error details to console
                $('#formResponse').html('<p class="text-danger">An error occurred. Please try again later.</p>');
            }
        });
    });
});
