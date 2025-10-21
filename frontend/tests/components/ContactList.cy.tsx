import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContactList from '../../src/components/ContactList'


describe('ContactList.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContactList /></Provider>)
  })
})