export default function() {
    const brownFieldCheckbox = document.querySelector('#brownfield-checkbox');
    const greenFieldCheckbox = document.querySelector('#greenfield-checkbox');
    const brownFieldAreaBlock = document.querySelector('#brownfield-area-block');
    const greenFieldAreaBlock = document.querySelector('#greenfield-area-block');

    console.log({
        brownFieldCheckbox,
        greenFieldCheckbox,
        brownFieldAreaBlock,
        greenFieldAreaBlock
    });

    function checkFieldTypeCheckboxes() {
        if (brownFieldCheckbox && brownFieldCheckbox.checked) {
            brownFieldAreaBlock.classList.add('active');
        } else {
            brownFieldAreaBlock.classList.remove('active');
        }
        if (greenFieldCheckbox && greenFieldCheckbox.checked) {
            greenFieldAreaBlock.classList.add('active');
        } else {
            greenFieldAreaBlock.classList.remove('active');
        }
    }

    if (brownFieldCheckbox && greenFieldCheckbox) {
        checkFieldTypeCheckboxes();
    }

   

    if (brownFieldCheckbox && greenFieldCheckbox) {
        const checkboxes = [brownFieldCheckbox, greenFieldCheckbox];

        checkboxes.forEach(element => {
            element.addEventListener('change', checkFieldTypeCheckboxes);
        });
    }

    const infraBlockCheckboxes = document.querySelectorAll('.objects-map__filters-infra-block input[type="checkbox"]');

    function handleInfraBlockActivity() {
        infraBlockCheckboxes.forEach(box => {
            const boxParentBlock = box.closest('.objects-map__filters-infra-block');
            if (box.checked) {
                boxParentBlock.classList.add('active');
                console.log({
                    checked: box.checked,
                    box
                })
            } else {
                boxParentBlock.classList.remove('active');
            }
        });
    }

    infraBlockCheckboxes.forEach(box => box.addEventListener('change', handleInfraBlockActivity));

    handleInfraBlockActivity();

    document.addEventListener('reset', () => {
        console.log('Reset event');
        handleInfraBlockActivity();
        if (brownFieldCheckbox && greenFieldCheckbox) {
            checkFieldTypeCheckboxes();
        }
    })
}
