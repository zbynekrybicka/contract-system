import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Calendar from '../../src/components/Calendar'


describe('Calendar.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Calendar /></Provider>)
  })
})