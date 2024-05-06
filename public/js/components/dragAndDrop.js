class dragAndDrop {
    constructor(pContenedor) {
        //Conseguir nodo NAV
        let contenedor = pContenedor.tagName
            ? pContenedor
            : document.querySelector(pContenedor);

        if (!contenedor) {
            console.error("Elemento HTML para generar la dropArea no encontrado");
            return;
        }

        //contenedor.classList.add("dragAndDrop");
        //contenedor.classList.add("menuHam-Abrir");

        //https://www.youtube.com/watch?v=qWFwYLUGWrc

        let css = tools.nuevoElemento("link","",{rel: "stylesheet",href:"/js/components/styles/dragAndDrop.css"})
        document.head.appendChild(css);
        // Armar Boton
        //let boton = tools.nuevoElemento("button", "", {
        //    class:"menuHam-Inicial"
        //});

        const dropArea = document.querySelector(".drop-area");
        const dragText = document.querySelector("h3");
        const button = document.querySelector("button");
        const input = document.querySelector(".inputfile");
        let files;

        input.addEventListener("click", (event) => {
            input.click();
        })

        input.addEventListener("change", (event) => {
            files = input.files;
            dropArea.classList.add("active");
            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    processFile(file);
                });
            }
            dropArea.classList.remove("active");
        });

        dropArea.addEventListener("dragover", (event) =>{
            event.preventDefault();
            dropArea.classList.add("active");
            dragText.textContent = "Suelta para subir los archivos"
        })
        dropArea.addEventListener("dragleave", (event) =>{
            event.preventDefault();
            dropArea.classList.remove("active");
            dragText.textContent = "Arrastra y suelta imagenes"
        })
        dropArea.addEventListener("drop", (event) => {
            event.preventDefault();
            files = event.dataTransfer.files;
            if (files.length > 0) {
                // Procesar cada archivo en `files`
                Array.from(files).forEach(file => {
                    processFile(file);
                });
            }
            dropArea.classList.remove("active");
            dragText.textContent = "Arrastra y suelta imágenes";
        });

        function showFiles(files) {
            if(files.length == undefined) {
                processFile(files);
            }
        }

        function processFile(file) {
            const docType = file.type;
            const validExtensions = ['image/jpeg','image/jpg','image/png','image/gif'];

            if(validExtensions.includes(docType)) {
                const fileReader = new FileReader();
                const id = `file-${Math.random().toString(32).substring(7)}`;

                fileReader.addEventListener('load', (event) => {
                    const fileUrl = fileReader.result;
                    const image = `
                        <div id="${id}" class="file-container">
                            <img src="${fileUrl}" alt="${file.name}" width="50">
                            <div class="status">
                                <span>${file.name}</span>
                                <span class="status-text">
                                Loading...
                                </span>
                            </div>
                        </div>
                    `;
                    const html = document.querySelector('.preview').innerHTML;
                    document.querySelector('.preview').innerHTML = image + html;
                });
                fileReader.readAsDataURL(file);
                //uploadFile(file, id);
            } else {
                alert("No es un archivo valido");
            }

        }

    /*
    function uploadFile(file, id) {
        const formData = new FormData();
        formData.append("file",file);

        try {
            const response = await fetch("http://localhost:3000/upload", {
                method: "POST",
                body: formData,
            });
            const responseText = await response.text();
            document.querySelector(
                `#${id}.status-text`
            ).innerHTML = `<span class="success"> Archivo subido correctamente...</span>`;
        } catch(error) {
            document.querySelector(
                `#${id}.status-text`
            ).innerHTML = `<span class="failure"> El archivo no pudo subirse...</span>`;
        }
    }
    */
        //Insertar boton en el NAX
        //contenedor.prepend(boton);
    }
}