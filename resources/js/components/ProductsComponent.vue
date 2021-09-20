<template>
<div>
 
    <!-- Button trigger modal -->

 
<!-- Modal Productos-->
<div class="modal fade" :class="{show:modal}">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{titleModal}}</h5>
        <button @click="CloseModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col"> 
                    <label for="name">Nombre</label>
                    <input v-model="product.name" id="name" type="text" name="name" class="form-control">
                </div>
                <div class="col-">
                    <label for="ref">Referencia</label>
                    <input v-model="product.ref" id="ref" type="text" name="ref" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <label for="description">Descripcion</label>
                    <textarea v-model="product.description" id="description" name="description" class="form-control">

                    </textarea>
                     
                </div>
                <div class="col-md">
                   <!-- <label for="img">Imagen</label>
                    <input v-model="product.img" id="img" type="text" name="img" class="form-control">-->
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Imagen</label>
                        <input ref="fileupload" @change="getImg" type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <figure>
                       <img @click="OpenImgLightBox('storage/'+product.img)" v-if="product.img" width="200" height="200" class="img-thumbnail" :src="'storage/'+product.img" alt="">
                                <img v-if="!product.img" width="200" height="200" class="img-thumbnail"
                                data-toggle="tooltip" data-placement="top" title="No tiene imagen" src="storage/storage/uploads/no-image.png" alt="">
                    </figure>
                    
                </div>
            </div>

            <div>
                <div>
                    <label for="category">Categoria</label>

                    <select class="form-control" v-model="product.category" name="" id="">
                        <option v-for="category,key in categories" :key="key" :value="key">{{category}}</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="model">Modelo</label>
                    <input v-model="product.model" id="model" type="text" name="model" class="form-control">
                </div>
                <div class="col">
                    <label for="provider">Proveedor</label>
                    <input v-model="product.provider" id="provider" type="text" name="provider" class="form-control">
                </div>
            </div>
                
                <div>
                    <label for="notes">Notas</label>
                    <textarea v-model="product.notes" id="notes" type="text" name="notes" class="form-control">

                    </textarea>
                </div>
                <div>
                    <label for="product_key">Clave de producto  y/o servicio (para facturacion en mexico)</label>
                    <input v-model="product.product_key" id="product_key" type="number" name="product_key" class="form-control">
                </div>
                <div>
                    <label for="unit_sale_key">Clave de unidad de venta  (para facturacion en mexico)</label>
                    <input v-model="product.unit_sale_key" id="unit_sale_key" type="number" name="unit_sale_key" class="form-control">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="sale_price">Precio de Venta</label>
                        <input v-model="product.sale_price" id="sale_price" type="number" name="sale_price" class="form-control">
                    </div>
                    <div class="col">
                        <label for="bar_code">Codigo de Barras</label>
                        <input v-model="product.bar_code" id="bar_code" type="number" name="bar_code" class="form-control">
                    </div>
                </div>

                  
            
        </div>      
    </div>
      <div class="modal-footer">
        <button @click="CloseModal()" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button @click="guardar()" type="button" class="btn btn-success">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Imagen-->
<div class="modal fade bg-secondary" @click="CloseModal()" :class="{show:img_modal}">
  <div class="modal-dialog modal-dialog-centered bg-sec ondary" role="document">
    <div class="">
       
          
        <button @click="CloseModal()" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      
      <div class="modal-body text-center">
        <img style="max-height:80vh;max-width: 80%;" :src="imagen_lightBox" alt="">
      </div>
    </div>
  </div>
</div>




    <div class="container">
        <div class="row justify-content-center">
           <h1>Gestion de productos </h1>
           <button title="Crear Nuevo" @click="update=false;OpenModal()" type="button" class="btn btn-primary">
  +
</button>
        </div>
    </div>
    <div class="container">
         
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table  table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Notas</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Codigo de Barras</th>
                        <th scope="col">Categoria</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="prod in products" :key="prod.id">
                        <th scope="row">{{prod.id}}</th>
                        <td>{{prod.name}}</td>
                        <th scope="row">
                              
                                <img @click="OpenImgLightBox('storage/'+prod.img)" v-if="prod.img" width="200" height="200" class="img-thumbnail" :src="'storage/'+prod.img" alt="">
                                <img v-if="!prod.img" width="200" height="200" class="img-thumbnail"
                                data-toggle="tooltip" data-placement="top" title="No tiene imagen" src="storage/storage/uploads/no-image.png" alt="">
  
                              
                            </th>
                        <td>{{prod.description}}</td>
                        <td>{{prod.provider}}</td>
                        <td>{{prod.model}}</td>
                        <td>{{prod.notes}}</td>
                        <td>{{prod.sale_price}}</td>
                        <td>{{prod.bar_code}}</td>
                        <td>{{categories[prod.category]}}</td>
                        <td>
                            <button @click="update=true;OpenModal(prod)" class="btn btn-warning">Editar</button>
                            <button @click="eliminar(prod.id)" class="btn btn-danger">Eliminar</button>
                        </td>
                        </tr> 
                    </tbody>
                    </table> 
            </div>
        </div>
    </div>
       
</div>
</template>

<script>
    export default {
        data(){
            return{
                categories: {
                    1:'Routers',
                    2:'Seguridad',
                    3:'Internet',
                },
                imagenMiniatura:'',
                product:{
                    ref:'',
                    name:'',
                    description:'',
                    img:'',
                    model:'',
                    provider:'',
                    notes:'',
                    category:'',
                    product_key:'',
                    unit_sale_key:'',
                    sale_price:'',
                    bar_code:'',                   
                    file:{}
                },
                id:0,
                update:true,
                modal:0,
                img_modal:0,
                lightBoxImg:'',
                titleModal: '',
                products:[]
            }
        },
        methods:{
             async list(){ 
                 const res = await axios.get('products');
                 this.products =  res.data;
             },
             async eliminar(id){
                  
                 const res = await axios.delete('/products/'+id);
                 this.list();
             },  
             async guardar(){

                 let fields = new FormData();
                 for (let key in this.product){
                     if(this.product[key] != null ){
                        fields.append(key, this.product[key]); 
                     }
                    
                }   
                 

                 if(this.update){
                     const res = await axios.post('/updateproducts/'+ this.id, fields);
                 }else{
                     const res = await axios.post('/products', fields);
                 }
                 this.CloseModal();
                 this.list();
             },  
             OpenModal(data={}){
                 if(this.update){
                     this.id = data.id;
                     this.titleModal = 'Modificar Producto';
                     this.product.ref = data.ref;
                     this.product.name = data.name;
                     this.product.description = data.description;
                     this.product.img = data.img;
                     this.product.model = data.model;
                     this.product.provider = data.provider;
                     this.product.notes = data.notes;
                     this.product.category = data.category;
                     this.product.product_key = data.product_key;
                     this.product.unit_sale_key = data.unit_sale_key;
                     this.product.sale_price = data.sale_price;
                     this.product.bar_code = data.bar_code;

                     this.imagenMiniatura = 'storage/'+this.product.img;
                 }else{
                     this.id = 0;
                     this.titleModal = 'Crear Producto';
                     this.product.ref ='';
                     this.product.name ='';
                     this.product.description ='';
                     this.product.img ='';
                     this.product.model ='';
                     this.product.provider ='';
                     this.product.notes ='';
                     this.product.category =1;
                     this.product.product_key ='';
                     this.product.unit_sale_key ='';
                     this.product.sale_price ='';
                     this.product.bar_code ='';
                 }
                 this.modal = 1;
             },
             OpenImgLightBox(img){
                 this.img_modal = 1;
                 this.lightBoxImg = img;
             },
             CloseModal(){
                this.modal = 0;
                this.img_modal = 0;
                this.$refs.fileupload.value=null;
                this.imagenMiniatura = '';
             },
             getImg(e){
                 let file = e.target.files[0];
                 this.product.file = file;
                 console.log(this.product);
                 this.LoadImage(file);
                 
             },
             LoadImage(file){
                let reader = new FileReader();
                reader.onload = (e)=> {
                    this.imagenMiniatura = e.target.result;
                }
                reader.readAsDataURL(file) ;   
             }
        },
        created(){
            this.list();
        },
        computed: {
            imagen(){
                return this.imagenMiniatura;
            },
            imagen_lightBox(){
                return this.lightBoxImg;
            }
        }
    }
</script>
<style>
    .show{
        display: inline;
        opacity: 1;
        /*background: rgba(red, green, blue, alpha);*/
    }
</style>