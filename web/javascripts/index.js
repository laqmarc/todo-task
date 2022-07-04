//drag
function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

//allowdrop
function allowDrop(ev) {
  ev.preventDefault();
}

//drop
function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
  console.log(data);
  console.log(" to ")
  console.log(ev.target.id);

  updateStatus(data, ev.target.id);

}
//update the status
async function updateStatus(id, status) {

  //fetch API interface Headers
  const headers = new Headers();
  //treiem el task- per saber la id
  id = id.replace("task-", "");

  //try -- catch
  try {
    // the response
    const lilu = await fetch('/todo-task/web/update-state', {
      method: 'POST',
      headers: headers,
      body: JSON.stringify({
        'id': id,
        'status': status
      })
    })

    //if tot ok
    if (lilu.status === 200) {
      console.log('resposta ok ', lilu);
      //response
      let response = await lilu.json()
      //new state
      let newState = response.status;
      // change the status 
      let element = document.querySelector('#task-' + id + ' .taskStatus');
      element.innerHTML = newState;
      //finish
      if (newState === 'finish') {
        window.location.replace("/todo-task/web/");
      }
    } else {
      console.log('response error: ', lilu.json());
    }
  } catch (error) {
    return {
      error: true,
      info: error.message
    }
  }
}

//


// Per al movil....

//check 
// https://github.com/timruffles/mobile-drag-drop