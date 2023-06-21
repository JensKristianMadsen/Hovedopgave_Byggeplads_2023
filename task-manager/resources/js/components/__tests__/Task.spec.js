import { test, expect} from 'vitest';
import Task from '../Task.vue';
import { mount } from '@vue/test-utils';





// Test if the taskaraea is the sa

test('Task descriptionInput ', async () => {
    const wrapper = mount(Task);
    const description = 'Test om det virker: taskDescription';

    const descriptionInput = wrapper.find('textarea[name="taskDescription"]');

    await descriptionInput.setValue(description);
    
    expect(descriptionInput.element.value).toBe(description);
  

});
