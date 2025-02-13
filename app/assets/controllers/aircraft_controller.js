import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = ['picturePreview','fileLoader', 'dropcontainer'];
    connect() {
        const dropzone = this.dropcontainerTarget;
        dropzone.addEventListener("dragover",(e) =>{
            e.preventDefault();
        }, false);
        dropzone.addEventListener("dragenter",(e) =>{
            dropzone.classList.add('drag-active');
        });
        dropzone.addEventListener("dragleave",(e) =>{
            dropzone.classList.remove('drag-active');
        });
        dropzone.addEventListener("drop",(e) =>{
            e.preventDefault();
            dropzone.classList.remove('drag-active');
            this.fileLoaderTarget.files = e.dataTransfer.files;
            this.changeFile();
        });
    }

    changeFile() {
        
        const fileLoader = this.fileLoaderTarget;
        const file = fileLoader.files[0];
        console.log(file);
        //files = this.fileLoaderTarget.files;
        if(file.type === 'image/jpeg' || file.type === 'image/png') {
            const container = this.picturePreviewTarget;
            if(container.childElementCount>0) {
                container.removeChild(container.firstChild);
            }
            const image = document.createElement("img");
            image.src = URL.createObjectURL(file);
            image.classList.add('preview');
            container.appendChild(image);
        }
    }
}