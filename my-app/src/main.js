// import './app.css'
import App from './App.svelte'
import App2 from './App2.svelte'

let app;
let app2;

if (document.getElementById('app') !== null) {
  app = new App({
    target: document.getElementById('app')
  })
}

if (document.getElementById('app2') !== null) {
  app2 = new App2({
    target: document.getElementById('app2')
  })
}

export let ex_app = app;
export let ex_app2 = app2;
