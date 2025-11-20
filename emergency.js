console.log('hello from javascript');
const step1 = document.getElementById('step1');
const step2 = document.getElementById('step2');
const step3 = document.getElementById('step3');
const step4 = document.getElementById('step4');
const step5 = document.getElementById('step5');
const names = document.getElementById('name');
const stage = document.getElementById('stage');
const todo = document.getElementById('todo');
const stat = document.getElementById('stat');
const grid = document.getElementById('grid');
const searchSection = document.getElementById('search');
const allSection = document.getElementById('all');

async function findit() {
  const find = document.getElementById('find').value;
  if (find.trim() === '') {
    window.alert('Search box was empty!!!');
    return;
  }
  await getData(find);
}

async function getData(query) {
  const x = query.toLowerCase().trim();
  clearDisplay();
  let found = false;

  try {
    const resp = await fetch('emergency.json');
    if (!resp.ok) throw new Error('Network response not ok');
    const data = await resp.json();

    for (let i = 0; i < data.length; i++) {
      const item = data[i];
      const searchable = [
        item.name,
        item.stage,
        item.step1, item.step2, item.step3, item.step4, item.step5,
        item.todo
      ]
        .filter(Boolean)    
        .join(' ')
        .toLowerCase();

      if (searchable.includes(x)) {
        if (stat) stat.style.display = 'none';
        if (grid) grid.style.display = 'none';
        if (searchSection) searchSection.style.display = 'none';
        if (allSection) allSection.style.display = 'block';

        names.textContent = item.name || '';
        stage.textContent = item.stage || '';
        step1.textContent = item.step1 || '';
        step2.textContent = item.step2 || '';
        step3.textContent = item.step3 || '';
        step4.textContent = item.step4 || '';
        step5.textContent = item.step5 || '';
        todo.textContent = item.todo || '';

        found = true;
        break; 
      }
    }

    if (!found) {
      window.alert(`${query} was not found`);
    }
  } catch (err) {
    console.error(err);
    window.alert('Something went wrong!!!');
  }
}

function clearDisplay() {
  if (allSection) allSection.style.display = 'none';
  if (stat) stat.style.display = '';
  if (grid) grid.style.display = '';
  if (searchSection) searchSection.style.display = '';
  names.textContent = '';
  stage.textContent = '';
  step1.textContent = '';
  step2.textContent = '';
  step3.textContent = '';
  step4.textContent = '';
  step5.textContent = '';
  todo.textContent = '';
}
