let itemsArray = ["1","1","1","1","1"];

const containers = document.querySelectorAll('#mainContainer');

containers.forEach(container => {
  const gridContainer = container.querySelector('#container');
  const items = gridContainer.children;

  itemsArray = new Array(items.length).fill("1");

  Array.prototype.forEach.call(items, item => {
    item.addEventListener('mouseover', function(event) {
      const itemId = Array.prototype.indexOf.call(items, item);
      itemsArray = new Array(items.length).fill("1");
      itemsArray[itemId] = 3;
      gridContainer.style.gridTemplateColumns = itemsArray.join("fr ") + "fr";
    });
  });

  Array.prototype.forEach.call(items, item => {
    item.addEventListener('mouseout', function(event) {
      itemsArray = new Array(items.length).fill("1");
      gridContainer.style.gridTemplateColumns = itemsArray.join("fr ") + "fr";
    });
  });
});
// Carousel
const carouselKenBurns = document.querySelector('#carouselKenBurns');
if (carouselKenBurns) {
  const firstAnimatingElems = carouselKenBurns.querySelectorAll('.carousel-item:first-child [data-animation^="animated"]');
  doAnimations(firstAnimatingElems);

  carouselKenBurns.addEventListener('slid.bs.carousel', (e) => {
    const animatingElems = e.relatedTarget.querySelectorAll("[data-animation^='animated']");
    doAnimations(animatingElems);
  });
}

function doAnimations(elems) {
  elems.forEach((elem) => {
    elem.classList.add('animate__animated', 'animate__flipInX');
    elem.addEventListener('animationend', () => {
      elem.classList.remove('animate__animated', 'animate__flipInX');
    });
  });
}

// Accordion
jQuery(document).ready(function(){
  jQuery('.titleWrapper').click(function(){
    var toggle = jQuery(this).next('div#descwrapper');
    if (toggle.length) {
      toggle.slideToggle("slow");
    }
  });
  jQuery('.inactive').click(function(){
    jQuery(this).toggleClass('inactive active');
  });
});

// Buy
const slider = document.querySelector('#priceSlider');
if (slider) {
  const display = document.querySelector('#sliderValue');
  const products = document.querySelectorAll('.product');

  slider.oninput = function() {
    const sliderValue = parseInt(this.value);
    if (isNaN(sliderValue)) return;
    display.textContent = `\$${sliderValue}`;

    products.forEach((product) => {
      const price = parseInt(product.dataset.price);
      if (isNaN(price)) return;
      if (sliderValue > parseInt(this.min) && sliderValue < parseInt(this.max)) {
        if (sliderValue >= price) {
          gsap.to(product, {autoAlpha: 1, scale: 1, duration: 0.5});
        } else {
          gsap.to(product, {autoAlpha: 0, scale: 0.8, duration: 0.5});
        }
      } else {
        gsap.to(product, {autoAlpha: 1, scale: 1, duration: 0.5});
      }
    });
  };
}

// Form dropbox
const fileInput = document.querySelector(".default-file-input");
if (fileInput) {
  let fileFlag = 0;
  let uploadedFile = document.querySelector(".file-block");
  let fileName = document.querySelector(".file-name");
  let fileSize = document.querySelector(".file-size");
  let progressBar = document.querySelector(".progress-bar");
  let removeFileButton = document.querySelector(".remove-file-icon");
  let uploadButton = document.querySelector(".upload-button");
  let cannotUploadMessage = document.querySelector(".cannot-upload-message");
  let cancelAlertButton = document.querySelector(".cancel-alert-button");
  let draggableFileArea = document.querySelector(".drag-file-area");
  let uploadIcon = document.querySelector(".upload-icon");
  let dragDropText = document.querySelector(".dynamic-message");
  let browseFileText = document.querySelector(".browse-files");
  let label = document.querySelector(".label");

  fileInput.addEventListener("click", () => {
    fileInput.value = '';
  });

  fileInput.addEventListener("change", (e) => {
    console.log(" > " + fileInput.value)
    uploadIcon.innerHTML = 'check_circle';
    dragDropText.innerHTML = 'File Dropped Successfully!';
    label.innerHTML = `drag & drop or <span class="browse-files"> <input type="file" class="default-file-input" style=""/> <span class="browse-files-text" style="top:0;"> browse file</span></span>`;
    uploadButton.innerHTML = `Upload`;
    fileName.innerHTML = fileInput.files[0].name;
    fileSize.innerHTML = (fileInput.files[0].size/1024).toFixed(1) + " KB";
    uploadedFile.style.cssText = "display: flex;";
    progressBar.style.width = 0;
    fileFlag = 0;
  });

  uploadButton.addEventListener("click", () => {
    let isFileUploaded = fileInput.value;
    if(isFileUploaded!= '') {
      if (fileFlag == 0) {
        fileFlag = 1;
        var width = 0;
        var id = setInterval(frame, 50);
        function frame() {
          if (width >= 390) {
            clearInterval(id);
            uploadButton.innerHTML = `<span class="material-icons-outlined upload-button-icon"> check_circle </span> Uploaded`;
          } else {
            width += 5;
            progressBar.style.width = width + "px";
          }
        }
      }
    } else {
      cannotUploadMessage.style.cssText = "display: flex; animation: fadeIn linear 1.5s;";
    }
  });

  cancelAlertButton.addEventListener("click", () => {
    cannotUploadMessage.style.cssText = "display: none;";
  });

  if(isAdvancedUpload()) {
    ["drag", "dragstart", "dragend", "dragover", "dragenter", "dragleave", "drop"].forEach((evt) => 
      draggableFileArea.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
      })
    );

    ["dragover", "dragenter"].forEach((evt) => {
      draggableFileArea.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        uploadIcon.innerHTML = 'file_download';
        dragDropText.innerHTML = 'Drop your file here!';
      });
    });

    draggableFileArea.addEventListener("drop", (e) => {
      uploadIcon.innerHTML = 'check_circle';
      dragDropText.innerHTML = 'File Dropped Successfully!';
      label.innerHTML = `drag & drop or <span class="browse-files"> <input type="file" class="default-file-input" style=""/> <span class="browse-files-text" style="top: -23px; left: -20px;"> browse file</span> </span>`;
      uploadButton.innerHTML = `Upload`;
      
      let files = e.dataTransfer.files;
      fileInput.files = files;
      console.log(files[0].name + " " + files[0].size);
      console.log(document.querySelector(".default-file-input").value);
      fileName.innerHTML = files[0].name;
      fileSize.innerHTML = (files[0].size/1024).toFixed(1) + " KB";
      uploadedFile.style.cssText = "display: flex;";
      progressBar.style.width = 0;
      fileFlag = 0;
    });
  }

  removeFileButton.addEventListener("click", () => {
    uploadedFile.style.cssText = "display: none;";
    fileInput.value = '';
    uploadIcon.innerHTML = 'file_upload';
    dragDropText.innerHTML = 'Drag & drop any file here';
    label.innerHTML = `or <span class="browse-files"> <input type="file" class="default-file-input"/> <span class="browse-files-text">browse file</span> <span>from device</span> </span>`;
    uploadButton.innerHTML = `Upload`;
  });
}

function isAdvancedUpload() {
  var div = document.createElement('div');
  return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}
