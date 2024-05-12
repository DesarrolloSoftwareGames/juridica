// fetch a local json file with all the municipios in Colombia
// and return it as an array of objects according to the department
// recieved as a parameter
// The json file is located in the same folder

document.getElementById("depa").addEventListener("change", async (e) => {
  const municipios = await getMunicipios(e.target.value);
  const municipiosSelect = document.getElementById("muni");
  municipiosSelect.innerHTML = "";
  municipios.forEach((municipio) => {
    const option = document.createElement("option");
    option.value = municipio.municipio;
    option.textContent = municipio.municipio;
    municipiosSelect.appendChild(option);
  });
});

const getMunicipios = async (departamento) => {
  const municipios = require("./municipios.json");
  return municipios.filter(
    (municipio) => municipio.departamento === departamento
  );
};
export default getMunicipios;
