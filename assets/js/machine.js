

// var data=new FormData(form)
const valores = window.location.search;
//Creamos la instancia
const urlParams = new URLSearchParams(valores);

//Accedemos a los valores
var producto = urlParams.get('m');

// console.log('hola1')
//conjunto de horas para turno 2
const hoursTurn2 = [
    "19:00 a 20:00",
    "20:00 a 21:00",
    "21:00 a 22:00",
    "22:00 a 23:00",
    "23:00 a 00:00",
    "00:00 a 1:00",
    "1:00 a 2:00",
    "2:00 a 3:00",
    "3:00 a 4:00",
    "4:00 a 5:00",
    "5:00 a 6:00",
    "6:00 a 7:00"
];

//rellena las tablas
const dataTemplate = (element, index, hour, turn) => {
    var totalTeoric = 60 * 45;
    var percentage = parseInt((element / totalTeoric) * 100);
    var dataRow = `<tr class="hour-item">
                    <th scope="row">${index + 1}</th>
                    <td>${hour}</td>
                    <td>
                        <div class="progressbar">
                            <div class="progressbar-color" style="width:${percentage}%;max-width:100%">
                               <p class="progressbar-number">${percentage}%</p>
                            </div>
                        </div>
                    </td>
                    <td>${element}</td>
                    <td>${totalTeoric}</td>
                </tr>`;
    turn.innerHTML += dataRow;
};
//rellena el template de la funcion dataTemplate 
const dataResponse = (data) => {
    data.forEach((element, index) => {
        if (index >= 12) {
            dataTemplate(element, index - 12, hoursTurn2[index - 12], turn2);
        } else {
            var hour = (index + 7) + ':00 a ' + (index + 8) + ':00'
            dataTemplate(element, index, hour, turn1);
        }
    });

};

//solicita al server
function request(date, producto) {
    fetch("backend/machine.php?date=" + date + '&m=' + producto, {
        method: "POST",
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.length == 0) {
                feeback.innerHTML = `<p class="alert alert-danger">no hay información de la fecha seleccionda</p>`
                feeback1.innerHTML = `<p class="alert alert-danger">no hay información de la fecha seleccionda</p>`

            } else {
                feeback.innerHTML = ''
                feeback1.innerHTML = ''

            }
            dataResponse(data);
        });
}

date.addEventListener('input', function () {
    request(date.value, producto)
    feeback.innerHTML = `<p class="alert alert-success">Cargando...</p>`
    feeback1.innerHTML = `<p class="alert alert-success">Cargando...</p>`
    turn1.innerHTML = ''
    turn2.innerHTML = ''
})



const changeRecipe = () => {
     feedback1.innerHTML=''
     
    fetch("backend/recipes.php?action=selectAll", {
        method: "POST",
    })
        .then((res) => res.json())
        .then((data) => {
            fillRecipes(data)
        });


}

const update=()=>{
    var id=idRecipe.value
    fetch("backend/recipes.php?action=selectRecipe1&id="+id, {
        method: "POST",
    })
        .then((res) => res.json())
        .then((data) => {
            if (data) {
                recipesList.value=data.ID_RECIPE
                ppm.value=data.PPM
            }
          
            
        });
    
}

const fillRecipes = data => {
    recipesList.innerHTML = ''
    data.forEach(element => {
        var template = `<option value="${element.id}">${element.name}</option>`
        recipesList.innerHTML += template
    })
    update()

}


const addRecipe = () => {

    if (recipe.value.length > 0) {
        var data = new FormData()
        data.append('name', recipe.value)
        fetch("backend/recipes.php?action=add", {
            method: "POST",
            body: data
        })
            .then((res) => res.json())
            .then((data) => {
                feedback.innerHTML = `<p class="alert alert-success my-1">${data}</p>`
                recipe.value = ''
            });

    } else {
        feedback.innerHTML = `<p class="alert alert-danger my-1">Escriba una receta</p>`

    }



}

const setRecipe = () => {
    var data = new FormData()
    data.append('name', recipesList.value)
    data.append('ppm', ppm.value)
    fetch("backend/recipes.php?action=set1&m=03", {
        method: "POST",
        body: data
    })
        .then((res) => res.json())
        .then((data) => {
            feedback1.innerHTML = `<p class="alert alert-success my-1">${data}</p>`
            ppm.value = ''
            selectRecipe()
        });

}

const selectRecipe = () => {
    fetch("backend/recipes.php?action=selectRecipe", {
        method: "POST",
    })
        .then((res) => res.json())
        .then((data) => {
            if (data) {
                fillRecipe(data)
            }
        
            
        });

}

const fillRecipe=(data)=>{
    idRecipe.value=data.ID
    const template=`<div class="d-flex align-items-center px-4 py-2 gap-3 justify-content-between border-bottom">
    <b>Receta actual</b>
    <div>
      <button class="btn btn-outline-success btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#ModalAddRecipe" id="btnChangeRecipe" onclick="changeRecipe()">Cambiar</button>
      <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#ModalNewRecipe" id="btnNewRecipe" onclick="feedback.innerHTML=''">Nuevo</button>
    </div>
  </div>
  <div class="d-flex gap-5 px-4 py-2 justify-content-between">
    <p><span>Receta: </span><b>${data.NAME}</b></p>
    <p><span>Objetivo (ppm): </span><b>${data.PPM}</b></p>
  </div>`
recipeSection.innerHTML=template
}

const updateRecipe= () => {
    var data = new FormData()
    data.append('id', idRecipe.value)
    data.append('name', recipesList.value)
    data.append('ppm', ppm.value)
    fetch("backend/recipes.php?action=update", {
        method: "POST",
        body: data
    })
        .then((res) => res.json())
        .then((data) => {
            feedback1.innerHTML = `<p class="alert alert-success my-1">${data}</p>`
            ppm.value = ''
            selectRecipe()
        });

}


selectRecipe()


btnSetRecipe.addEventListener('click', () => {
    if (!idRecipe.value=='') {
       
       updateRecipe()
    }else{
        setRecipe()
        
    }



})



btnAddRecipe.addEventListener('click', () => {
    
    addRecipe()

})


setRecipeBtn.addEventListener('click',()=>{
   
    changeRecipe()
    btnSetRecipe.innerHTML='Agregar'
})


