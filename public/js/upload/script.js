const form = document.querySelector("form"),
  fileInput = document.querySelector(".file-input"),
  progressArea = document.querySelector(".progress-area"),
  uploadedArea = document.querySelector(".uploaded-area");

// form click event
form.addEventListener("click", () => {
  fileInput.click();
});

fileInput.onchange = ({ target }) => {
  uploadedArea.innerHTML = "";
  let file = [];
  file = target.files; //getting file [0] this means if user has selected multiple files then get first one only
  // console.log(file[0]['name']);
  if (file) {
    let fileName = []; //getting file name
    for (i = 0; i < file.length; i++) {
      fileName += file[i].name;
      if (i < file.length - 1) {
        fileName += ",";
      }
    }
    let arr = fileName.toString().split(',');
    uploadFile(arr); //calling uploadFile with passing file name as an argument
  }
}

// file upload function
function uploadFile(name) {
  let xhr = new XMLHttpRequest(); //creating new xhr object (AJAX)
  xhr.open("POST", "/js/upload/php/upload.php"); //sending post request to the specified URL
  for (i = 0; i < name.length; i++) {
    let uploadedHTML = `<li class="row">
                              <div class="content upload">
                                <i class="fas fa-file-alt"></i>
                                <div class="details">
                                  <span class="name">${name[i]} • Uploaded</span>
                                </div>
                              </div>
                              <i class="fas fa-check"></i>
                            </li>`;
    uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML); //remove this line if you don't want to show upload history
  }
}