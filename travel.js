function changeContent(page) {
    var title = document.getElementById('page-title');
    var content = document.getElementById('page-content');
    
    switch (page) {
      case 'Journeys':
        title.innerHTML = 'Journeys';
        content.innerHTML = '<p>This is the home page.</p>';
        break;
        case 'Profile':
            title.innerHTML = 'Profile';
            content.innerHTML = '<form action="profile_submit.php" method="post"> \
                                   <label for="name">Name:</label> \
                                   <input type="text" name="name" id="name" class="input-field"> \
                                   <br> \
                                   <label for="email">Email:</label> \
                                   <input type="email" name="email" id="email" class="input-field"> \
                                   <br> \
                                   <label for="phone">Phone:</label> \
                                   <input type="tel" name="phone" id="phone" class="input-field"> \
                                   <br> \
                                   <div class="btn-field"> \
                                   <button type="submit" >Update profile</button> \
                                   </div>\
                                 </form>';
            break;          
      case 'Logout':
        title.innerHTML = 'Logout';
        content.innerHTML = '<p>This is the contact page.</p>';
        break;
      default:
        title.innerHTML = 'Error';
        content.innerHTML = '<p>Page not found.</p>';
        break;
    }
  }
  