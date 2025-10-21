import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContactDetail from '../../src/components/ContactDetail'


describe('ContactDetail.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContactDetail /></Provider>)
  })
})