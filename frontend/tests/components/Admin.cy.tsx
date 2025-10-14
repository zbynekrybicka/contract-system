import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Admin from '../../src/components/Admin'


describe('Admin.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Admin /></Provider>)
  })
})