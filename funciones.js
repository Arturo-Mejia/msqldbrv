function vertabla(tablename)
{
  let host=document.getElementById("hostname").value;
  let user=document.getElementById("username").value;
  let userpass=document.getElementById("userpass").value;
  let dbname=document.getElementById("databasename").value;

  const http=new XMLHttpRequest();
  const url="mostrartabla.php?host="+host+"&user="+user+"&pass="+userpass+"&db="+dbname+"&table="+tablename;
http.onreadystatechange= function()
      {
          if(this.readyState == 4 && this.status==200)
          {
              
                  document.getElementById("tablas").innerHTML=this.responseText;
          }
      }  
  
      http.open("GET",url);
      http.send(); 
}

function obtenerjson()
{   document.getElementById("tablas").innerHTML="";
    let email=document.getElementById("email").value;
    let pass=document.getElementById("pass").value;
    const http=new XMLHttpRequest();
    const url="obtenerjson.php?email="+email+"&pass="+pass;

    if(email==""||pass=="")
    {  
        alert("Para realizar la consulta debe ingresar su usuario y contraseña");

    } else
    {   
        document.getElementById("btnlogin").style.display="none";
        document.getElementById("loading").style.display="block";
        http.onreadystatechange= function()
        {
            if(this.readyState == 4 && this.status==200)
            {
                let respuesta= this.responseText;
                console.log(respuesta);
             if(respuesta==0)
             {
                Swal.fire({
                    text: 'No se encontraron resultados',
                    imageUrl: 'assets/img/nores.jpg',
                    imageWidth: 400,
                    imageHeight: 300,
                    imageAlt: 'Custom image',
                  })
                  document.getElementById("btnlogin").style.display="";
                  document.getElementById("loading").style.display="none";
             }else
             {  
                 document.getElementById("ocultos").innerHTML=this.responseText;
                 cargartablas(); 
             }
                
            }
        }  
    
        http.open("GET",url);
        http.send(); 

    }
}

function cargartablas()
{    
    let host=document.getElementById("hostname").value;
    let user=document.getElementById("username").value;
    let userpass=document.getElementById("userpass").value;
    let dbname=document.getElementById("databasename").value;

    const http=new XMLHttpRequest();
    const url="obtenertablas.php?host="+host+"&user="+user+"&pass="+userpass+"&db="+dbname;
http.onreadystatechange= function()
        {
            if(this.readyState == 4 && this.status==200)
            {
                if(this.responseText==0)
                {  document.getElementById("btnlogin").style.display="";
                document.getElementById("loading").style.display="none";
                document.getElementById("contenedort").innerHTML='<img src="assets/img/dbtables.jpg" class="imgdb"/> <h2 style="width: 100%;">Su base de datos aun no contine tablas</h2>'; 
                } else
                {  
                    document.getElementById("btnlogin").style.display="";
                document.getElementById("loading").style.display="none";
                document.getElementById("contenedort").innerHTML=this.responseText;
                } 
                
            }
        }  
    
        http.open("GET",url);
        http.send(); 

}