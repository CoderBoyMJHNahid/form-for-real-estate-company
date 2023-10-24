
const changeContent = (close,open) => {

    document.querySelector(open).classList.remove("d-none");
    document.querySelector(close).classList.add("d-none");

};

const province = document.getElementById("province_input");


province.addEventListener("click",async ()=>{
    
    let listHTML = "";

    const response = await fetch("http://ovc.catastro.meh.es/OVCServWeb/OVCWcfCallejero/COVCCallejero.svc/json/ObtenerProvincias");

    const data = await response.json();
    const result = data.consulta_provincieroResult.provinciero.prov;
    

    result.forEach(elem => {
        listHTML +=`<li onclick='setResult("province_input","${elem.np}")'>${elem.np}</li>`;
    });

    document.getElementById("province_list").innerHTML = listHTML;

});

const closeSubmenu =(target)=>{
    setTimeout(()=>{
        document.getElementById(target).innerHTML = "";
    },200)
}

const setResult = (target,value)=>{
    document.getElementById(target).value = value;
}

const municipality = document.getElementById("municipality_input");

municipality.addEventListener("click",async ()=>{

    const province_val = province.value;

    if (province_val !== "") {

        let listHTML = "";

        const response = await fetch(`http://ovc.catastro.meh.es/OVCServWeb/OVCWcfCallejero/COVCCallejero.svc/json/ObtenerMunicipios?Provincia=${province_val}`);

        const data = await response.json();

        const result = data.consulta_municipieroResult.municipiero.muni;
        
        
        result.forEach(elem => {
            listHTML +=`<li onclick='setResult("municipality_input","${elem.nm}")'>${elem.nm}</li>`;
        });

        document.getElementById("municipality_list").innerHTML = listHTML;

    } else {
        changeContent(".four_form",".second_form");
    }

});


const via_input = document.getElementById("via_input");

via_input.addEventListener("click",async ()=>{

    const province_val = province.value;
    const municipality_val = municipality.value;

    if (province_val !== "" && municipality_val !== "") {

        let listHTML = "";

        const response = await fetch(`http://ovc.catastro.meh.es/OVCServWeb/OVCWcfCallejero/COVCCallejero.svc/json/ObtenerCallejero?Provincia=${province_val}&Municipio=${municipality_val}`);
        

        const data = await response.json();
        

        const result = data.consulta_callejeroResult.callejero.calle;
        
        
        result.forEach(elem => {
            listHTML +=`<li onclick='setResult("via_input","${elem.dir.nv}")'>${elem.dir.nv}</li>`;
        });

        document.getElementById("via_list").innerHTML = listHTML;

    } else {
        changeContent(".four_form",".second_form");
    }

})

const finalSubmit = async ()=>{
    const number_input = document.getElementById("number_input").value;
    const province_val = province.value;
    const municipality_val = municipality.value;
    const via = via_input.value;

    if (number_input !== "" && province_val !== "" && municipality_val !== "" && via !== "") {
        
        const response = await fetch(`http://ovc.catastro.meh.es/OVCServWeb/OVCWcfCallejero/COVCCallejero.svc/json/ObtenerNumerero?Provincia=${province_val}&Municipio=${municipality_val}&NomVia=${via}&Numero=${number_input}`);

        
        const result = await response.json();
        
        document.getElementById("spinner").style.display = "flex";

        if (result.consulta_numereroResult && result.consulta_numereroResult.lerr && result.consulta_numereroResult.lerr.hasOwnProperty("err")) {
            
            document.getElementById("spinner").style.display = "none";
            console.log("ERROR");

            document.getElementById("error_massage").innerHTML =`<p class='text-danger'>The indicated number is not found in the cadastre record, it may not be correct. Some alternative numbers could be: You can obtain more information on the official CADASTRE website.</p>`;

        } else if (result.consulta_numereroResult && result.consulta_numereroResult.hasOwnProperty("nump")) {

            document.getElementById("error_massage").innerHTML =``;

            console.log("working");

            const objectData = {
                province:province_val,
                municipality: municipality_val,
                via:via,
                number:number_input
            }
            
            const res = await fetch("./includes/save_data.php",{
                headers: { 'Content-Type': 'application/json' },
                method: 'POST',
                body: JSON.stringify(objectData)
            })

            const data = await res.json();

            if (data.status === "true") {
                window.location = "thank.html";
            }else{
                document.getElementById("spinner").style.display = "none";
                document.getElementById("error_massage").innerHTML =`Something went wrong. Please try again!!`;
            }
            
        }

    } else {
        document.getElementById("error_massage").innerHTML =`<p class="text-danger">All fields are mandatory. Please fill up and try again!</p>`;

    }
}