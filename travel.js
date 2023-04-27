function changeContent(page) {
    var title = document.getElementById('page-title');
    var content = document.getElementById('page-content');

    var xhr;
    
    switch (page) {
      case 'Journeys':
        title.innerHTML = 'Journeys';
        content.innerHTML = '<p>This is the home page.</p>';
        break;
        case 'Profile':
            title.innerHTML = 'Profile';
            // make AJAX request to get user data
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_user_data.php');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var userData = JSON.parse(xhr.responseText);
                    // update form fields with user data
                    var usernameField = document.getElementById('username');
                    var emailField = document.getElementById('email');
                    var imagePreview = document.getElementById('image-preview');
                    usernameField.value = userData.username;
                    emailField.value = userData.email;
                    // update the 'src' attribute of the 'img' element to display the profile picture
                    imagePreview.src = userData.image_url;
                } else {
                    console.log('Error getting user data');
                }
            };
            xhr.send();
            // display form
            content.innerHTML = '<form action="upate_profile_submit.php" method="post" enctype="multipart/form-data"> \
                <label for="username">Username:</label> \
                <input type="text" name="username" id="username" class="input-field"> \
                <br> \
                <label for="email">Email:</label> \
                <input type="email" name="email" id="email" class="input-field"> \
                <br> \
                <label for="image">Profile Picture:</label>\
                <br> \
                <img src="" id="image-preview" class="images_data">\
                <br> \
                <input type="file" name="image" id="image" class="input-field" accept="image/*">\
                <br> \
                <div class="btn-field"> \
                    <button type="submit">Update profile</button> \
                </div>\
            </form>';
            break;
                    
            case 'Logout':
      title.innerHTML = 'Logout';
      // send an AJAX request to the server to end the session
      xhr = new XMLHttpRequest(); // assign the value here
      xhr.open('POST', 'logout.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // redirect the user to the login page after the session has been ended
          window.location.href = 'Login.php';
        }
      };
      xhr.send();
      break;              
      default:
        title.innerHTML = 'Error';
        content.innerHTML = '<p>Page not found.</p>';
        break;
    }
  }
  