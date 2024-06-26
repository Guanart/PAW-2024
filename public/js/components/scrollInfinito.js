class ScrollInfinito{
    constructor(){
        this.page = 1;
        this.loading = document.getElementById('loading');
        this.container = document.getElementsByClassName('menu')[0];
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                this.cargarMasProductos();
            }
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        });

        observer.observe(this.loading);
        this.loading.style.display = 'none';
    }

    async cargarMasProductos() {
        try {
            this.loading.style.display = 'block';
            const response = await fetch(`${window.location.origin}/menu_page?page=${this.page}`);
            const data = await response.json();

            data.forEach(item => {
                const art = document.createElement('article');
                const pic = document.createElement("picture");
                const img = document.createElement("img");
                const h3 = document.createElement("h3");
                const p =  document.createElement("p");
                console.log(item);
                art.className = 'armar_pedido';

                img.src = item.fields["path_img"] ? item.fields["path_img"] : "#";
                pic.appendChild(img);
                h3.textContent = item.fields["nombre"];
                p.textContent = `${item.fields["descripcion"]}  ${item.fields["precio"]}`;
                
                art.appendChild(pic);
                art.appendChild(h3);
                art.appendChild(p);
                this.container.insertBefore(art, this.container.lastElementChild);
            });

            this.page++;
        } catch (error) {
            console.error('Error al cargar más datos:', error);
        } finally {
            this.loading.style.display = 'none';
        }
    };
}

{/* <article class="armar_pedido">
    <picture>
        <img src= "{{item.pathImg}}" >
    </picture>
    <h3>{{item.nombre}}</h3>
    <p> 
        {{item.descripcion}}
        <br>
        {{item.precio}}
    </p>
</article> */}