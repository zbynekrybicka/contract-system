import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import Contracts from '../../src/components/Contracts'


describe('Contracts.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><Contracts /></Provider>)
  })
})