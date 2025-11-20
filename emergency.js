console.log('hello from javascript')
// 1.Name
// 2.stage
// 3.Steps

let step1=document.getElementById('step1')
let step2=document.getElementById('step2')
let step3=document.getElementById('step3')
let step4=document.getElementById('step4')
let step5=document.getElementById('step5')
let names=document.getElementById('name')
let stage=document.getElementById('stage')
let todo=document.getElementById('todo')
let stat=document.getElementById('stat')
let grid=document.getElementById('grid')


function findit()
{
    let find=document.getElementById('find').value
    if(!isNaN(find))
    {
        window.alert('Search box was empty!!!')
    }
    else
    {
        getData(find);
    }
}

function getData(x)
{
    console.log(x)
    x=x.toLowerCase().trim();
    fetch('emergency.json')
    .then((resp)=>{return resp.json()})
    .then((value)=>{
        console.log(value)
        for(i=0;i<value.length;i++)
        {
            if(x===value[i].name)
            {
                stat.style.display="none";
                grid.style.display="none";
                document.getElementById('all').style="block";
                names.textContent=value[i].name
                stage.textContent=value[i].stage
                step1.textContent=value[i].step1
                step2.textContent=value[i].step2
                step3.textContent=value[i].step3
                step4.textContent=value[i].step4
                step5.textContent=value[i].step5
                todo.textContent=value[i].todo
            }
            else
            {
               window.alert(x+' was not found')
            }
        }
    })
    .catch(()=>{window.alert("Something went wrong!!!")})
}