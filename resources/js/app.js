import './bootstrap';
// Display a success toast, with a title
// toastr.success('Have fun storming the castle!', 'Miracle Max Says')

var userId = 3;

Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {
        // console.log(notification.msg);
        toastr.success(notification.msg);
    });