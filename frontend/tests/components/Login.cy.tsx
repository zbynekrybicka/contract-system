import { Provider } from 'react-redux'
import Login from '../../src/components/Login'
import { store }  from '../../src/store'


describe('Login.cy.tsx', () => {
  it('playground', () => {
    cy.mount(<Provider store={store}><Login /></Provider>)
    cy.get("input:eq(0)").type("test@demo.cz")
    cy.get("input:eq(1)").type("password123")
  })
})