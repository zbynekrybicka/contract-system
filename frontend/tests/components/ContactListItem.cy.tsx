import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContactListItem from '../../src/components/ContactListItem'


describe('ContactListItem.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContactListItem /></Provider>)
  })
})