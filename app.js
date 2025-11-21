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

function findit() {
  const find = document.getElementById('find').value;
  if (!find || find.trim() === '') {
    window.alert('Search box was empty!!!');
    return;
  }
  getData(find).catch(err => {
    console.error(err);
    window.alert('Something went wrong!!!');
  });
}

// Promise-based fetch
function getData(query) {
  clearDisplay();

  // Build API URL (relative to current host)
  const url = `api.php?q=${encodeURIComponent(query)`;