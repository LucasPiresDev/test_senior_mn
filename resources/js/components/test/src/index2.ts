import People from "./People";

let people = new People('Lucas Pires', 29, ['Portugues', 'Inglês']);
console.log(people);

let el = document.getElementById('content');

el.innerHTML = `<h3>Pessoa</h3>`
el.innerHTML += `<p>Nome: ${people.getName()}</p>`
el.innerHTML += `<p>Idade: ${people.getAge()}</p>`
el.innerHTML += `<p>Línguas: ${people.getLanguages().join(', ')}</p>`