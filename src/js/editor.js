"use strict"

if(document.getElementById('question-text-area') != null) {
  let editor = new Editor({
    element: document.getElementById('question-text-area')
  });

  editor.render();
}

