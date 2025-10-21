import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContactFilter from '../../src/components/ContactFilter'


describe('ContactFilter.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContactFilter /></Provider>)
  })
})