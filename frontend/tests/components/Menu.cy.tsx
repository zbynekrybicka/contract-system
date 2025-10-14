import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Menu from '../../src/components/Menu'


describe('Menu.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Menu /></Provider>)
  })
})