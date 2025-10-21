import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Contacts from '../../src/components/Contacts'


describe('Contacts.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Contacts /></Provider>)
  })
})